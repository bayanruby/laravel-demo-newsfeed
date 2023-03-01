<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $newsList = News::orderByDesc('created_at')->withWhereHas('categories', function (BelongsToMany|EloquentBuilder $query) use ($slug) {
            $query->where('slug', $slug);
        })->paginate(News::PAGINATION_COUNT);

        $categories = Category::all();

        return view('news.category', compact('newsList', 'categories', 'slug'));
    }
}
