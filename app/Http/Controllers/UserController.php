<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\UploadTraits;
use Illuminate\Support\Arr;
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
        info(auth()->user());

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

    public function store(Request $request)
    {

        // return response()->json([
        //     'data' => $request->all()
        // ], 200);
        try {
            info($request->all());
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'role_id' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            info($validatedData);

            $user = User::create(array_merge(
                Arr::except($validatedData, ['image'])
            ));

            if ($request->hasFile('image')) {
                $user->update([
                    'image' => $this->uploadFile($request->file('image')),
                ]);
            }

            $user->sendCreatePasswordNotification();

            return response()->json(['success' => 'Berhasil disimpan.']);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->first('email');
            Log::error('Failed to save user: ' . $errors);
            return response()->json(['error' => $e], 422);
        } catch (\Exception $e) {
            Log::error('Failed to save user: ' . $e->getMessage());
            return response()->json(['error' => $e], 500);
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
            info($request);
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
}
