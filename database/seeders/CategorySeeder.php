<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'  => 'X線検査',
                'slug'  => 'xray',
                'order' => 0,
            ],
            [
                'name'  => 'CT検査',
                'slug'  => 'ct',
                'order' => 1,
            ],
            [
                'name'  => 'MRI検査',
                'slug'  => 'mri',
                'order' => 2,
            ],
            [
                'name'  => 'エコー検査',
                'slug'  => 'us',
                'order' => 3,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
