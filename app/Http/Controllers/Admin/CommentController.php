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
        ], [
            'name.required' => 'İsim alanı gereklidir.',
            'name.string' => 'İsim geçerli bir metin olmalıdır.',
            'name.max' => 'İsim en fazla 255 karakter olabilir.',
            
            'email.required' => 'E-posta alanı gereklidir.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi girin.',
            'email.max' => 'E-posta en fazla 255 karakter olabilir.',
            
            'comment.required' => 'Yorum alanı gereklidir.',
            'comment.string' => 'Yorum geçerli bir metin olmalıdır.',
            'comment.max' => 'Yorum en fazla 500 karakter olabilir.',
            
            'rating.required' => 'Puan alanı gereklidir.',
            'rating.integer' => 'Puan geçerli bir sayı olmalıdır.',
            'rating.between' => 'Puan 1 ile 5 arasında olmalıdır.',
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
