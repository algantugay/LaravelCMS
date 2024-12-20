<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Category;

class FrontendController extends Controller
{
        // Anasayfa
        public function index()
        {
            $pages = Page::where('status', 'published')->latest()->paginate(10);
            $categories = Category::all();
    
            return view('frontend.index', compact('pages', 'categories'));
        }
    
        // Sayfa Detay
        public function showPage($slug)
        {
            $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
            return view('frontend.page', compact('page'));
        }
    
        // Kategoriye Göre Filtreleme
        public function showCategory($slug)
        {
            $category = Category::where('slug', $slug)->firstOrFail();
            $pages = $category->pages()->where('status', 'published')->paginate(10);
            return view('frontend.category', compact('category', 'pages'));
        }
}
