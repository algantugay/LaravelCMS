<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;



class CommentController extends Controller
{
    // Yorumları listeleme
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    // Yorum durumunu güncelleme
    public function updateStatus(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = $request->status;
        $comment->save();
    
        return redirect()->route('admin.comments.index')->with('success', 'Yorum durumu başarıyla güncellendi.');
    }
    
    // Yorum silme
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Yorum başarıyla silindi.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);
    
        Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'status' => 'pending',
            'rating' => $request->rating,
        ]);
    
        return back()->with('success', 'Yorumunuz başarıyla gönderildi.');
    }
}
