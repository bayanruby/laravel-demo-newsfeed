<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleCreateRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::query()->orderByDesc('created_at')->withWhereHas('categories')->paginate();

        $categories = Category::query()->orderByDesc('is_active')->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::query()->active()->get();

        return view('admin.articles.create', compact('categories'));
    }

    public function store(ArticleCreateRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $article = new Article();
            $article->title = $request->input('title');
            $article->description = $request->input('description');
            $article->content = $request->input('content');
            $article->save();

            $article->categories()->sync($request->input('category'));
        });

        return to_route('admin.articles.index')->with('status', __('Новость успешно добавлена'));
    }

    public function edit(int $article): View
    {
        $article = Article::query()->findOrFail($article);

        $categories = Category::query()->active()->get();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(ArticleUpdateRequest $request, int $article): RedirectResponse
    {
        $article = Article::query()->findOrFail($article);

        DB::transaction(function () use ($request, $article) {
            $article->title = $request->input('title');
            $article->description = $request->input('description');
            $article->content = $request->input('content');
            $article->update();

            $article->categories()->sync($request->input('category'));
        });

        return to_route('admin.articles.edit', $article)->with('status', __('Новость успешно обновлена'));
    }

    public function destroy(int $article)
    {
        $article = Article::query()->findOrFail($article);
        $article->delete();

        return to_route('admin.articles.index')->with('status', __('Новость успешно удалена'));
    }
}
