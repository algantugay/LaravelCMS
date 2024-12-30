<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->route('contact.show')->with('success', 'Mesajınız başarıyla gönderildi!');
    }

    public function showReplyForm($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.reply', compact('message'));
    }

    public function submitReply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $message = Message::findOrFail($id);
        $message->update([
            'reply' => $request->reply,
        ]);

        return redirect()->route('admin.messages')->with('success', 'Yanıtınız başarıyla gönderildi!');
    }

    public function listMessages()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }
    
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
    
        return redirect()->route('admin.messages')->with('success', 'Mesaj başarıyla silindi!');
    }

}
