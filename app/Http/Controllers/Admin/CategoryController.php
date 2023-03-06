<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->orderByDesc('is_active')->orderByDesc('created_at')->paginate();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(CategoryCreateRequest $request): RedirectResponse
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->save();

        return to_route('admin.categories.index')->with('status', __('Категория успешно добавлена'));;
    }

    public function edit(int $category): View
    {
        $category = Category::query()->findOrFail($category);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, int $category): RedirectResponse
    {
        $category = Category::query()->findOrFail($category);
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->update();

        return to_route('admin.categories.edit', $category)->with('status', __('Категория успешно обновлена'));
    }

    public function articles(string $slug): View
    {
        $articles = Article::query()->orderByDesc('created_at')->withWhereHas('categories', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })->paginate();

        $categories = Category::query()->orderByDesc('is_active')->get();

        $currentCategory = $categories->firstWhere('slug', $slug);

        return view('admin.articles.index', compact('articles', 'currentCategory', 'categories'));
    }

    public function archive(int $category)
    {
        $category = Category::query()->findOrFail($category);
        $category->archive();

        return to_route('admin.categories.index')->with('status', __('Категория успешно скрыта'));
    }

    public function unarchive(int $category)
    {
        $category = Category::query()->findOrFail($category);
        $category->unarchive();

        return to_route('admin.categories.index')->with('status', __('Категория успешно восстановлена'));
    }
}
