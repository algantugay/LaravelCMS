<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.create', compact('categories'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:draft,published',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Resim doğrulama
    ]);

    // Diğer alanları alıyoruz
    $validated = $request->only(['title', 'content', 'status', 'category_id']);

    // Resim yükleme işlemi
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('pages', 'public'); // 'pages' klasörüne yükle
        $validated['image_path'] = $path; // image_path alanına kaydediyoruz
    }

    Page::create($validated); // Veritabanına kaydet

    return redirect()->route('admin.pages.index')->with('success', 'Sayfa başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $categories = Category::all();
        return view('admin.pages.edit', compact('page', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'category_id' => 'nullable|integer',
            'image_path' => 'nullable|image|max:1024',
        ]);
    
        $page = Page::find($id);
        $validated = $request->only(['title', 'content', 'status', 'category_id']);
    
        if ($request->hasFile('image_path')) {
            // Eski resmi sil
            if ($page->image_path && Storage::disk('public')->exists($page->image_path)) {
                Storage::disk('public')->delete($page->image_path);
            }
    
            // Yeni resmi yükle
            $path = $request->file('image_path')->store('pages', 'public');
            $validated['image_path'] = $path;
        }
    
        $page->update($validated);
    
        return redirect()->route('admin.pages.index')->with('success', 'Sayfa başarıyla güncellendi.');
    }    

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Sayfa başarıyla silindi!');
    }
}

