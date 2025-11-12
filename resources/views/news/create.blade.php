<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Berita | Berita Cihuy</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-8">
  <a href="{{ route('news.index') }}" 
     class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full shadow-md transition transform hover:-translate-x-1 hover:shadow-lg">
    <i class="fas fa-arrow-left"></i>
    <span class="font-semibold">Kembali ke Berita Cihuy</span>
  </a>

  <div class="bg-white max-w-3xl mx-auto p-6 rounded-xl shadow-md mt-6">
    <h1 class="text-3xl font-bold text-green-700 mb-4">Tambah Berita Baru</h1>

    @if($errors->any())
      <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('news.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
      @csrf

      <div>
        <label class="block font-semibold">Judul</label>
        <input type="text" name="judul" value="{{ old('judul') }}" class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-green-400" placeholder="Judul berita...">
      </div>

      <div>
        <label class="block font-semibold">Ringkasan</label>
        <input type="text" name="ringkasan" value="{{ old('ringkasan') }}" class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-green-400" placeholder="Ringkasan singkat berita...">
      </div>

      <div>
        <label class="block font-semibold">Isi Berita</label>
        <textarea name="isi" rows="8" class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-green-400" placeholder="Isi lengkap berita...">{{ old('isi') }}</textarea>
      </div>

      <div>
        <label class="block font-semibold">Gambar (opsional)</label>
        <input type="file" name="gambar" accept="image/*" class="border border-gray-300 rounded-lg w-full p-2">
      </div>

      <div>
        <label class="block font-semibold">Wartawan</label>
        <select name="id_wartawan" class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-green-400">
          <option value="">-- Pilih Wartawan --</option>
          @foreach($wartawan as $w)
            <option value="{{ $w->id }}" {{ old('id_wartawan') == $w->id ? 'selected' : '' }}>{{ $w->nama }}</option>
          @endforeach
        </select>
      </div>
      <div>
  <label class="block font-semibold">Kategori</label>
  <select name="category_id" class="border border-gray-300 rounded-lg w-full p-2 focus:ring-2 focus:ring-green-400">
    <option value="">-- Pilih Kategori --</option>
    @foreach(\App\Models\Category::all() as $c)
      <option value="{{ $c->id }}">{{ $c->nama }}</option>
    @endforeach
  </select>
</div>


      <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
        Simpan Berita
      </button>
    </form>
  </div>
</body>
</html>
