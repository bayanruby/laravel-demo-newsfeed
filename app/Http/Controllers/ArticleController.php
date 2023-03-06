<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::query()->orderByDesc('created_at')->withWhereHas('categories', function (Builder $query) {
            $query->active();
        })->paginate();

        $categories = Category::query()->active()->has('articles')->get();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function show(int $article): View
    {
        $article = Article::query()->withWhereHas('categories', function (Builder $query) {
            $query->active();
        })->findOrFail($article);

        $categories = Category::query()->active()->has('articles')->get();

        return view('articles.show', compact('article', 'categories'));
    }
}
