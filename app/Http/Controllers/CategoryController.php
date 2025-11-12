<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;

class CategoryController extends Controller
{
    public function index($id)
    {
        $kategori = Category::findOrFail($id);
        $semua_berita = News::where('category_id', $kategori->id)
                            ->with('wartawan', 'komentar')
                            ->latest()
                            ->get();

        return view('news.index', compact('semua_berita', 'kategori'));
    }
}
