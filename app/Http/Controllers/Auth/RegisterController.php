<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'message' => 'Giriş Başarılı!',
                'redirect' => route('dashboard')
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Üzgünüz, tekrar deneyin!'
        ]);
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
    
        // Veritabanına yeni kullanıcı kaydetme
        $data = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ]);
    
        return response()->json(['message' => 'Kayıt başarılı!', 'data' => $data], 201);
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

        // Profil Fotoğrafı Güncelleme Kısmı
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // Yeni resmi kaydet
            $path = $request->file('avatar')->store('avatars', 'public');
        
            // Eski resmi sil
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        
            // Yeni avatar yolunu kaydet
            $user->avatar = $path;
        } else {
            // Avatar kaldırıldıysa
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        
            $user->avatar = null; // Varsayılan avatar (kaldırıldı)
        }
        
        $user->save();
        
        return redirect()->back()->with('success', 'Profil başarıyla güncellendi!');
    }

    public function updateEmail(Request $request)
    {
        // Form doğrulama
        $request->validate([
            'new_email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

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
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mevcut şifre hatalı.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Şifre başarıyla güncellendi');
    }
}
