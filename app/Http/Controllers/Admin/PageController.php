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
        $pages = Page::with('category')->paginate(10);
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
        'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ],[
        'title.required' => 'Başlık alanı gereklidir.',
        'title.string' => 'Başlık geçerli bir metin olmalıdır.',
        'title.max' => 'Başlık 255 karakteri geçemez.',
        'content.required' => 'İçerik alanı gereklidir.',
        'content.string' => 'İçerik geçerli bir metin olmalıdır.',
        'status.required' => 'Durum seçilmelidir.',
        'status.in' => 'Geçersiz durum değeri. Geçerli değerler: taslak, yayımlandı.',
        'image_path.image' => 'Yalnızca resim dosyaları kabul edilir.',
        'image_path.mimes' => 'Geçersiz dosya formatı. Sadece jpeg, png, jpg, gif dosyaları kabul edilir.',
        'image_path.max' => 'Resim dosyası maksimum 2MB olmalıdır.',
    ]);

    $validated = $request->only(['title', 'content', 'status', 'category_id']);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('pages', 'public');
        $validated['image_path'] = $path;
    }

    Page::create($validated);

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
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|max:2048',
        ],[
            'title.required' => 'Başlık alanı gereklidir.',
            'title.string' => 'Başlık geçerli bir metin olmalıdır.',
            'title.max' => 'Başlık 255 karakteri geçemez.',
            'content.required' => 'İçerik alanı gereklidir.',
            'content.string' => 'İçerik geçerli bir metin olmalıdır.',
            'status.required' => 'Durum seçilmelidir.',
            'status.in' => 'Geçersiz durum değeri. Geçerli değerler: taslak, yayımlandı.',
            'image_path.image' => 'Yalnızca resim dosyaları kabul edilir.',
            'image_path.mimes' => 'Geçersiz dosya formatı. Sadece jpeg, png, jpg, gif dosyaları kabul edilir.',
            'image_path.max' => 'Resim dosyası maksimum 2MB olmalıdır.',
        ]);
    
        $page = Page::find($id);
        $validated = $request->only(['title', 'content', 'status', 'category_id',]);
    
        if ($request->hasFile('image_path')) {

            if ($page->image_path && Storage::disk('public')->exists($page->image_path)) {
                Storage::disk('public')->delete($page->image_path);
            }

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

