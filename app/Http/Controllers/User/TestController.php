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
        $admin = User::where('role_id', 2)->first();

        $messages = Message::where('receiver_id', Auth::id())
            ->orWhere('sender_id', Auth::id())
            ->where(function ($query) use ($admin) {
                $query->where('receiver_id', $admin->id)
                      ->orWhere('sender_id', $admin->id);
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

        $admin = User::where('role_id', 2)->first();

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $admin->id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->route('user.messages.index')->with('success', 'Mesaj gönderildi!');
    }
}
