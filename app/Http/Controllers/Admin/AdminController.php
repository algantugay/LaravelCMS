<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index()
    {
        // Mesaj sayısını alıyoruz
        $messageCount = Message::count();
        
        // Yanıtlanmayan mesaj sayısını alıyoruz
        $unrepliedCount = Message::whereNull('reply')->count();
    
        // Kullanıcı sayısını alıyoruz
        $userCount = User::count();
        
        // Aktif kullanıcı sayısını alıyoruz (son giriş yapanlar)
        $activeUserCount = User::where('last_login', '>=', now()->subDays(7))->count(); // Son 7 gün içinde giriş yapan kullanıcılar
        
        // Son 5 mesajı alıyoruz
        $recentMessages = Message::latest()->take(5)->get();

        // Son 5 kullanıcı
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        // Son 5 mesaj
        $recentMessages = Message::orderBy('created_at', 'desc')->take(5)->get();

        // Son 5 Yorum
        $recentComments = Comment::orderBy('created_at', 'desc')->take(5)->get();
        
        // Son işlem kartı için genel log
        $recentActivities = $this->getRecentActivities();
    
        // Verileri view'a gönderiyoruz
        return view('admin.admin_index', compact('messageCount', 'unrepliedCount', 'userCount', 'activeUserCount', 'recentMessages','recentUsers', 'recentMessages', 'recentActivities','recentComments'));
    }

    private function getRecentActivities()
    {
        return [
            ['type' => 'user_created', 'name' => 'Yeni Kullanıcı', 'details' => 'Admin tarafından eklendi', 'created_at' => now()],
            ['type' => 'message_sent', 'name' => 'Yeni Mesaj', 'details' => 'Admin tarafından gönderildi', 'created_at' => now()->subMinutes(5)],
        ];
    }
    
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
    
            if ($user->role->role === 'admin') {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Admin rolüne sahip bir kullanıcı girmelisiniz.']);
            }
        }
        
        return response()->json(['error' => 'Email veya şifre hatalı.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
