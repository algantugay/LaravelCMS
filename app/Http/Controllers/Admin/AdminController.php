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
        $userCount = User::count();
        
        $activeUserCount = User::where('last_login', '>=', now()->subDays(7))->count();

        $receiverId = auth()->id();
        $totalMessagesCount = Message::where('receiver_id', $receiverId)->where('sender_id', '!=', $receiverId)->count();

        $unreadMessagesCount = Message::where('receiver_id', $receiverId)->where('is_read', 0)->where('sender_id', '!=', $receiverId)->count();
        
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        $recentComments = Comment::orderBy('created_at', 'desc')->take(5)->get();
          
        return view('admin.admin_index', compact('userCount', 'activeUserCount','recentUsers','recentComments', 'totalMessagesCount', 'unreadMessagesCount'));
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
