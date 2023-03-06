<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
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

        $randomCategories = array_rand(array_flip($categories), rand(5, 12));

        foreach ($randomCategories as $category) {
            $model = new Category();
            $model->name = $category;
            $model->slug = $category;
            $model->save();
        }
    }
}
