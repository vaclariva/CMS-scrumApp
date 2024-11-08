<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Traits\UploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    /**
     * Define traits.
     */
    use UploadTraits;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->latest()->get();
        $totalUser = User::count();

        return view('pages.users.user', compact('users', 'totalUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreUserRequest $request)
    {
        try {

            $validatedData = $request->validated();

            DB::beginTransaction();

            $user = User::create(array_merge(
                Arr::except($validatedData, ['image'])
            ));

            if ($request->hasFile('image')) {
                $user->update([
                    'image' => $this->uploadFile($request->file('image')),
                ]);
            }

            $user->sendCreatePasswordNotification();

            DB::commit();
            return response()->json([
                'message' => 'Berhasil disimpan.',
                'redirect' => route('user')
            ]);
        
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal disimpan.',
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'role' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $user->update(Arr::except($validatedData, ['image']));

            if ($request->hasFile('image')) {
                $this->deleteFile($user->image);
                $user->update([
                    'image' => $this->uploadFile($request->file('image')),
                ]);
            } elseif ($request->avatar_remove) {
                $user->update([
                    'image' => $this->deleteFile($user->getRawOriginal('image'))
                ]);
            }

            return redirect()->route('user')->with('success', 'Berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('user')->with('error', 'Gagal diperbarui.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->image) {
                $this->deleteFile($user->image);
            }

            $user->delete();
            return redirect()->route('user')->with('success', 'Berhasil menghapus.');
        } catch (\Exception $e) {
            return redirect()->route('user')->with('error', 'Gagal menghapus.');
        }
    }

    public function deleteImage(User $user)
    {
        $user->deleteImage();

        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }
    /**
     * Resend email create password
     */
    public function resendEmailRegister(User $user)
    {
        try {
        
            if (! $user->is_password_null) {
                return response()->json([
                    'message' => 'Gagal, kata sandi sudah di input sebelumnya',
                ], 403);
            }
        
            $user->sendCreatePasswordNotification();

            return response()->json([
                'message' => 'Tautan untuk reset kata sandi berhasil terkirim. Minta kepada pengguna baru untuk cek kotak masuk secara berkala.',
            ]);
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return response()->json([
                'message' => 'Gagal mengirim email.',
            ], 500);
        }
    }
}
