<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\News;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'pengunjung' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Komentar::create([
            'pengunjung' => $request->pengunjung,
            'isi' => $request->isi,
            'id_berita' => $id,
        ]);

        return redirect()->route('news.show', $id)->with('success', 'Komentar berhasil dikirim!');
    }

    public function destroy($id)
{
    $komentar = \App\Models\Komentar::findOrFail($id);
    $berita_id = $komentar->id_berita;
    $komentar->delete();

    return redirect()->route('news.show', $berita_id)->with('success', 'Komentar berhasil dihapus!');
}

}
