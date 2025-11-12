<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'judul',
        'ringkasan',
        'isi',
        'id_wartawan',
        'gambar',
    ];

    public function wartawan()
    {
        return $this->belongsTo(Wartawan::class, 'id_wartawan');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_berita');
    }

    public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

}
