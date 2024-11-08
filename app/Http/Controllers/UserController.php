<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Traits\UploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        if(auth()->user()->role()->first()->name != 'Super Admin'){
            abort(403);
        }

        try {
            $users = User::with('role')->latest()->get();
            
            $totalUser = User::count();

            return view('pages.users.user', compact('users', 'totalUser'));
        } catch (\Throwable $th) {
            info($th);
            
            abort(500);
        }
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
        if(auth()->user()->role()->first()->name != 'Super Admin'){
            abort(403);
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(auth()->user()->role()->first()->name != 'Super Admin'){
            abort(403);
        }

        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'role_id' => 'nullable|string|max:255',
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

            DB::commit();
            return redirect()->route('user')->with('success', 'Berhasil diperbarui.');
        } catch (\Exception $e) {
            info($e->getMessage());
            DB::commit();
            return redirect()->route('user')->with('error', 'Gagal diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        if(auth()->user()->role()->first()->name != 'Super Admin'){
            abort(403);
        }

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            if ($user->image) {
                $this->deleteFile($user->image);
            }

            $user->delete();

            DB::commit();
            return redirect()->route('user')->with('success', 'Berhasil menghapus.');
        } catch (\Exception $th) {
            info($th);
            DB::rollBack();
            return redirect()->route('user')->with('error', 'Gagal menghapus.');
        }
    }

    /**
     * Resend email create password
     */
    public function resendEmailRegister(User $user)
    {
        if(auth()->user()->role()->first()->name != 'Super Admin'){
            abort(403);
        }

        try {
        
            if (! $user->is_password_null) {
                return response()->json([
                    'message' => 'Gagal, kata sandi sudah di input sebelumnya',
                ], 500);
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
