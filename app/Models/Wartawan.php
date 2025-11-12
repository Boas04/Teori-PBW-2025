<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wartawan extends Model
{
    protected $table = 'wartawan';
    protected $fillable = ['nama', 'email'];

    public function news()
    {
        return $this->hasMany(News::class, 'id_wartawan');
    }
}
