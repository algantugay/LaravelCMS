<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user()->profile;
        return view('admin.profile.index', compact('profile'));
    }

    public function edit()
    {
        Auth::user();
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        $profile = Auth::user()->profile;

        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:profiles,email,' . $profile->id,
            'phone' => 'nullable|string|max:15',
            'country' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // Eski avatarı sil
            if ($profile->avatar) {
                Storage::delete('public/' . $profile->avatar);
            }
            $profile->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'avatar' => $profile->avatar,
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profil başarıyla güncellendi.');
    }
}
