<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Berita Cihuy</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<nav class="flex flex-wrap items-center gap-3">
  @foreach($categories as $cat)
    <a href="{{ route('kategori.show', $cat->id) }}" 
       class="text-gray-700 hover:text-green-700 text-sm font-medium px-3 py-1 rounded-lg
       {{ isset($kategori) && $kategori->id === $cat->id ? 'bg-green-100 text-green-700 font-semibold' : '' }}">
       {{ $cat->nama }}
    </a>
  @endforeach
</nav>

<body class="bg-gray-100 min-h-screen flex flex-col">

 <header class="flex items-center justify-between p-6 bg-white shadow-md sticky top-0 z-10">
  <div>
    <h1 class="text-2xl font-bold text-green-700">Berita Cihuy</h1>
    <p class="text-sm text-gray-500">Daftar Berita</p>
  </div>

  <nav class="flex items-center gap-4">
    @foreach(\App\Models\Category::all() as $cat)
      <a href="{{ route('kategori.show', $cat->id) }}" 
         class="text-gray-700 hover:text-green-700 font-medium">
         {{ $cat->nama }}
      </a>
    @endforeach
  </nav>

  <a href="{{ route('news.create') }}" 
     class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full shadow-md transition">
     + Tambah Berita
  </a>
</header>

  <!-- Grid Berita -->
  <main class="flex-grow p-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    @forelse($semua_berita as $item)
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
        @if($item->gambar)
          <img src="{{ asset('storage/'.$item->gambar) }}" alt="Gambar Berita" class="w-full h-40 object-cover">
        @else
          <img src="https://picsum.photos/400/200?random={{ $item->id }}" alt="Gambar Berita" class="w-full h-40 object-cover">
        @endif

        <div class="p-4">
          <h2 class="text-lg font-semibold text-gray-900 mb-1">{{ $item->judul }}</h2>
          <p class="text-sm text-gray-500 mb-3">
            Oleh {{ $item->wartawan->nama ?? 'Tidak Diketahui' }} • {{ $item->updated_at->diffForHumans() }}
            <p class="text-sm text-gray-500 mb-3">

          </p>
          <p class="text-gray-700 text-sm mb-4">{{ Str::limit($item->ringkasan, 100) }}</p>

          <div class="flex justify-between items-center">
            <a href="{{ route('news.show', $item->id) }}" 
               class="text-green-600 hover:text-green-800 font-semibold text-sm">Baca Selengkapnya</a>

            <form action="{{ route('news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">Hapus</button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <p class="text-gray-500 text-center col-span-full">Belum ada berita yang tersedia.</p>
    @endforelse
  </main>

  <!-- Footer -->
  <footer class="bg-white border-t border-gray-200 text-center text-gray-600 text-sm py-4">
    © {{ date('Y') }} <span class="font-semibold text-green-700">Berita Cihuy</span>. 
    Dibuat dengan semangat oleh <span class="font-semibold text-green-700">Abner Gultom</span>.
  </footer>

</body>
</html>
