<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Prestasi', 'Kegiatan Sekolah', 'Akademik', 'PPDB', 'PKL', 'Umum'];
        foreach ($categories as $name) {
            Category::updateOrCreate(['name' => $name], ['type' => 'news']);
        }
    }
}
