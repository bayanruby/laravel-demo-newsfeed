<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $content = $this->faker->paragraphs(rand(2, 7), true);
        $date = $this->faker->dateTimeBetween('-2 years');

        return [
            'title' => $this->faker->sentence(),
            'description' => Str::limit($content, rand(100, 230)),
            'content' => $content,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
