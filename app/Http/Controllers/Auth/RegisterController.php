<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function loginUser(Request $request)

    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ],
            [
                'email.required' => 'Email alanı zorunludur',
                'email.email'    => 'Geçerli bir email giriniz',
            ]
        ); {
            $input = $request->all();
            $password = Hash::make($request['password']);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Giriş başarılı
                return redirect()->route('dashboard');
                return response()->json(['message' => 'Giriş başarılı!'], 200);
            }

            // Giriş başarısız
            return response()->json(['error' => 'E-posta veya şifre hatalı.'], 401);
        }
    }

    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',

        ]);

        $data = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Kayıt başarılı!', 'data' => $data], 201); // bunu incele
    }

    public function overview()
    {
        // Giriş yapan kullanıcıyı al
        $user = Auth::user();

        // Blade'e gönder
        return view('overview', compact('user'));
    }

    public function updateName(Request $request)
    {
        // Kullanıcıdan gelen verileri doğrula
        $request->validate([
            'first_name' => 'required|string|max:255',
        ]);

        // Giriş yapmış olan kullanıcıyı al
        $user = Auth::user();

        // İsmi güncelle
        $user->name = $request->input('first_name');
        $user->save();

        //-- Profil Fotoğrafı Güncelleme Kısmı --

        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user =  Auth::user();

        if ($request->hasFile('profile_image')) {
            // Yeni resmi kaydet
            $path = $request->file('profile_image')->store('profile_images', 'public');

            // Eski resmi sil
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Yeni yolu kaydet
            $user->profile_image = $path;
        } else {
            // Profil resmi kaldırılmışsa
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $user->profile_image = null; // Varsayılan resim
        }

        $user->save();

        // Geri dönüş
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }


    public function updateEmail(Request $request)
    {
        // Form doğrulama
        $request->validate([
            'new_email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]); //yine validation işlemleri

        $user = Auth::user();

        // Şifre doğrulama
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Şifre yanlış.']);
        }

        // E-posta güncelleme
        $user->email = $request->new_email;
        $user->save();

        return back()->with('success', 'E-posta başarıyla güncellendi.');
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // confirmed: yeni şifre ve tekrarını kontrol eder
        ]);

        $user = Auth::user();

        // Mevcut şifre doğrulama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mevcut şifre hatalı.']);
        }

        // Şifre güncelleme
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Şifre başarıyla güncellendi');
    }
}
