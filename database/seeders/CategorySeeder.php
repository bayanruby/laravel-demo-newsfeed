<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Россия',
            'Мир',
            'Бывший СССР',
            'Экономика',
            'Силовые структуры',
            'Наука и техника',
            'Культура',
            'Спорт',
            'Интернет и СМИ',
            'Ценности',
            'Путешествия',
            'Из жизни',
        ];

        $randomCategories = array_rand(array_flip($categories), rand(4, 11));

        foreach ($randomCategories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category, '-')
            ]);
        }
    }
}
