<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        Article::factory()->count(250)->create()->each(function ($article) use ($categories) {
            $article->categories()->sync($categories->random(1));
        });
    }
}
