<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditController extends Controller
{
    function edit(User $user)
    {
        $user = auth()->user();
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();
        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            Storage::disk('public')->delete($user->profile_picture);

            $path = $request->file('profile_picture')->store('profiles', 'public');
            $data['profile_picture'] = $path;
        } else {
            $data['profile_picture'] = $user->profile_picture;
        }

        $user->update($data);
        return redirect()->route('home');
    }
}
