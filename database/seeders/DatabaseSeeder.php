<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wartawan;
use App\Models\News;
use App\Models\Komentar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $w1 = Wartawan::create(['nama' => 'Rumail Abas', 'email' => 'mail@mail.com']);
        $w2 = Wartawan::create(['nama' => 'Sigit Handoko', 'email' => 'sigit@mail.com']);

        $b1 = News::create([
            'judul' => 'Bekasi Juara Kebersihan',
            'ringkasan' => 'KDM memberikan penghargaan kepada Bekasi',
            'isi' => 'KDM memberikan penghargaan kepada Bekasi karena berhasil menjaga kebersihan kota.',
            'id_wartawan' => $w1->id
        ]);

        $b2 = News::create([
            'judul' => 'Hantu Baru di Depok',
            'ringkasan' => 'Viral di Depok ada Hantu mencuri Seblak',
            'isi' => 'Viral di Depok, sosok misterius mencuri seblak warga hingga membuat heboh!',
            'id_wartawan' => $w2->id
        ]);

        Komentar::create(['pengunjung' => 'Novan', 'isi' => 'Keren akhirnya Bekasi ada Prestasi', 'id_berita' => $b1->id]);
        Komentar::create(['pengunjung' => 'Emir', 'isi' => 'Kota kelahiran saya tuh', 'id_berita' => $b1->id]);
        Komentar::create(['pengunjung' => 'Soja', 'isi' => 'Yah saya dah jadi warga Depok', 'id_berita' => $b1->id]);
        Komentar::create(['pengunjung' => 'Soja', 'isi' => 'Gini amat jadi warga Depok', 'id_berita' => $b2->id]);
    }
}
