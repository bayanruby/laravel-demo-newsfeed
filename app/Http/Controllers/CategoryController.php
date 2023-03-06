<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function articles(string $slug): View
    {
        $currentCategory = Category::query()->where('slug', $slug)->active()->has('articles')->firstOrFail();

        $articles = Article::query()->orderByDesc('created_at')->withWhereHas('categories', function (Builder $query) use ($slug) {
            $query->where('slug', $slug)->active();
        })->paginate();

        $categories = Category::query()->active()->has('articles')->get();

        return view('articles.index', compact('articles', 'currentCategory', 'categories'));
    }
}
