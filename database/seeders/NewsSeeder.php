<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        News::factory()->count(250)->create()->each(function ($news) use ($categories) {
            $news->categories()->attach($categories->random(1));
        });
    }
}
