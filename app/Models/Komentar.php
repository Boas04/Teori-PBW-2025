<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $fillable = ['pengunjung', 'isi', 'id_berita'];

    public function news()
    {
        return $this->belongsTo(News::class, 'id_berita');
    }
}
