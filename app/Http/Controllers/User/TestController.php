<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index()
    {
        // Kullanıcıya ait gelen ve gönderilen tüm mesajları alıyoruz
        // Ancak sadece admin ile olan mesajları alıyoruz
        $messages = Message::where('receiver_id', Auth::id())
            ->orWhere('sender_id', Auth::id())
            ->where(function ($query) {
                $query->where('receiver_id', 2) // Admin ID'si
                      ->orWhere('sender_id', 2); // Admin ID'si
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.messages', compact('messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => 2, // Admin ID'si (değiştirilebilir)
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->route('user.messages.index')->with('success', 'Mesaj gönderildi!');
    }
}
