<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['nama' => 'Teknologi'],
            ['nama' => 'Olahraga'],
            ['nama' => 'Ekonomi'],
            ['nama' => 'Hiburan'],
            ['nama' => 'Politik'],
        ]);
    }
}
