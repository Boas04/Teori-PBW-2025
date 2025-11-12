<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Berita Cihuy</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-8">
  <h1 class="text-3xl font-bold mb-4">Berita Cihuy</h1>

  @foreach($semua_berita as $item)
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
      <h2 class="text-2xl font-semibold">{{ $item->judul }}</h2>
      <p class="text-sm text-gray-500 mb-2">Oleh {{ $item->wartawan->nama }}</p>
      <p class="text-gray-700 mb-2">{{ $item->ringkasan }}</p>

      <a href="{{ route('news.show', $item->id) }}" class="text-blue-500 hover:underline">Baca Selengkapnya →</a>
    </div>
  @endforeach
</body>
</html>
