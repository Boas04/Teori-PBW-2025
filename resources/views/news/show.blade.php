<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ $berita->judul }} | Berita Cihuy</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50 text-gray-800">

  <header class="bg-white shadow-sm">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center gap-4">
      <div>
        <h1 class="text-2xl font-bold text-green-700">Berita Cihuy</h1>
        <p class="text-sm text-gray-500">Daftar Berita</p>
      </div>
      <a href="{{ route('news.index') }}" class="ml-auto text-sm inline-flex items-center gap-2 text-green-600 hover:underline">
        <i class="fas fa-arrow-left"></i> Kembali ke Berita Cihuy
      </a>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
    <article class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden">
      @if($berita->gambar)
        <img src="{{ asset('storage/'.$berita->gambar) }}" alt="Gambar {{ $berita->judul }}" class="w-full h-64 object-cover">
      @else
        <img src="https://picsum.photos/1200/400?random={{ $berita->id }}" alt="Gambar fallback" class="w-full h-64 object-cover">
      @endif

      <div class="p-6">
        <h2 class="text-3xl font-extrabold mb-2">{{ $berita->judul }}</h2>

        <p class="text-sm text-gray-500 mb-6">
  Oleh <span class="font-semibold text-gray-700">{{ $berita->wartawan->nama ?? 'Tidak Diketahui' }}</span>
  • {{ $berita->updated_at->diffForHumans() }}
  @if($berita->category)
    | <span class="text-green-700 font-medium">Kategori: {{ $berita->category->nama }}</span>
  @endif
</p>


        <div class="prose prose-sm max-w-none text-gray-800">
          {!! nl2br(e($berita->isi)) !!}
        </div>

        <div class="mt-8 flex items-center justify-between">
          <div class="text-sm text-gray-600">
            Dipublikasikan: {{ $berita->created_at->format('d M Y H:i') }}
          </div>
          <div class="flex items-center gap-3">
            <a href="#komen" class="text-sm text-green-600 hover:underline">Lihat Komentar</a>
          </div>
        </div>
      </div>
    </article>

    <aside class="space-y-6">
      <div class="bg-white p-4 rounded-xl shadow-sm">
        <h3 class="font-semibold text-gray-700 mb-3">Berita Terbaru</h3>
        <ul class="space-y-3">
          @foreach(\App\Models\News::latest()->take(5)->get() as $n)
            <li>
              <a href="{{ route('news.show', $n->id) }}" class="block text-sm hover:underline text-gray-800">
                {{ Str::limit($n->judul, 60) }}
              </a>
              <div class="text-xs text-gray-500">{{ $n->updated_at->diffForHumans() }}</div>
            </li>
          @endforeach
        </ul>
      </div>

      <div class="bg-white p-4 rounded-xl shadow-sm">
        <h3 class="font-semibold text-gray-700 mb-3">Aksi</h3>
        <div class="flex flex-col gap-3">
          <a href="{{ route('news.create') }}" class="block text-center bg-green-600 text-white py-2 rounded">Tambah Berita</a>
          <a href="{{ route('news.index') }}" class="block text-center border border-gray-200 py-2 rounded text-sm">Kembali</a>
        </div>
      </div>
    </aside>
  </main>

  <section id="komen" class="max-w-6xl mx-auto px-6 pb-12">
    <div class="bg-white p-6 rounded-xl shadow-md">
      <h4 class="text-xl font-semibold mb-4">Komentar</h4>

      <ul class="space-y-4 mb-6">
        @forelse($berita->komentar as $komen)
          <li class="border rounded p-3">
            <div class="text-sm font-semibold">{{ $komen->pengunjung }}</div>
            <div class="text-sm text-gray-700 mt-1">{!! nl2br(e($komen->isi)) !!}</div>
            <div class="text-xs text-gray-400 mt-2">{{ $komen->created_at->diffForHumans() }}</div>

            <form action="{{ route('komentar.destroy', $komen->id) }}" method="POST" class="mt-2" onsubmit="return confirm('Yakin ingin menghapus komentar ini?');">
              @csrf
              @method('DELETE')
              <button class="text-red-600 text-xs">Hapus</button>
            </form>
          </li>
        @empty
          <li class="text-gray-500">Belum ada komentar.</li>
        @endforelse
      </ul>

      <form action="{{ route('komentar.store', $berita->id) }}" method="POST" class="space-y-3">
        @csrf
        <input name="pengunjung" class="w-full border p-2 rounded" placeholder="Nama" />
        <textarea name="isi" rows="4" class="w-full border p-2 rounded" placeholder="Tulis komentar..."></textarea>
        <button class="bg-green-600 text-white px-4 py-2 rounded">Kirim Komentar</button>
      </form>
    </div>
  </section>

  <footer class="bg-white border-t mt-8">
    <div class="max-w-6xl mx-auto px-6 py-6 text-center text-sm text-gray-600">
      © {{ date('Y') }} Berita Cihuy — dibuat oleh <span class="font-semibold text-green-700">Abner Gultom</span>
    </div>
  </footer>

</body>
</html>
