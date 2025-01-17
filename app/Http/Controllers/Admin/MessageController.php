<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $adminId = Auth::user()->id;
    
        $messages = Message::where('receiver_id', $adminId)  
                           ->where('sender_id', '!=', $adminId)
                           ->with('sender')
                           ->latest()
                           ->get()
                           ->groupBy('sender_id');
    
        $users = $messages->map(function ($messages) {
            return $messages->first(); 
        });
    
        return view('admin.messages.index', compact('users'));
    }
    
    public function show($userId)
    {
        $adminId = Auth::user()->id;
    
        $user = User::findOrFail($userId);
    
        Message::where('receiver_id', $adminId)
                ->where('sender_id', $userId)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
    
        $messages = Message::where(function($query) use ($userId, $adminId) {
            $query->where('sender_id', $adminId)
                  ->where('receiver_id', $userId);
        })
        ->orWhere(function($query) use ($userId, $adminId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $adminId);
        })
        ->orderBy('created_at', 'asc')
        ->get();
    
        return view('admin.messages.show', compact('messages', 'user'));
    }
         
    public function reply(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);
        
        $admin_id = auth()->user()->id;
    
        $message = new Message();
        $message->sender_id = $admin_id;
        $message->receiver_id = $validated['receiver_id'];
        $message->message = $validated['message'];
        $message->conversation_id = uniqid();
        $message->is_read = 0;
        $message->save();
        
        return redirect()->route('admin.messages.show', $validated['receiver_id'])->with('success', 'Mesaj başarıyla gönderildi.');
    }
    
    public function destroyUserMessages($user_id)
    {
        $adminId = Auth::user()->id;
    
        $messages = Message::where('sender_id', $user_id)
                            ->orWhere('receiver_id', $user_id)
                            ->get();
    
        $messages->each->delete();
        
        return redirect()->route('admin.messages.index')->with('success', 'Kullanıcıya ait tüm mesajlar silindi!');
    }
}
