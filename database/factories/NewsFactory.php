<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        $content = $this->faker->paragraphs(rand(2, 7), true);
        $date = $this->faker->dateTimeBetween('-5 years');

        return [
            'title' => $this->faker->sentence(),
            'description' => Str::limit($content, 100),
            'content' => $content,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
