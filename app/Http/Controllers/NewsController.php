<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Wartawan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $semua_berita = News::with('wartawan', 'komentar', 'category')->latest()->get();
        $categories = Category::all();

        return view('news.index', compact('semua_berita', 'categories'));
    }

    public function show($id)
    {
        $berita = News::with('wartawan', 'komentar', 'category')->findOrFail($id);
        $categories = Category::all(); // biar header tetap ada kategori

        return view('news.show', compact('berita', 'categories'));
    }

    public function create()
    {
        $wartawan = Wartawan::all();
        $categories = Category::all();
        return view('news.create', compact('wartawan', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'ringkasan' => 'required|string|max:500',
            'isi' => 'required|string',
            'id_wartawan' => 'required|exists:wartawan,id',
            'gambar' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only(['judul', 'ringkasan', 'isi', 'id_wartawan', 'category_id']);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('news-images', 'public');
            $data['gambar'] = $path;
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $berita = News::findOrFail($id);

        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function category($id)
    {
        $kategori = Category::findOrFail($id);
        $semua_berita = News::where('category_id', $kategori->id)
                            ->with('wartawan', 'komentar', 'category')
                            ->latest()
                            ->get();
        $categories = Category::all();

        return view('news.index', compact('semua_berita', 'categories', 'kategori'));
    }
}
