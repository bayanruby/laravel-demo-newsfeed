<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $newsList = News::orderByDesc('created_at')->paginate(News::PAGINATION_COUNT);

        $categories = Category::all();

        return view('news.index', compact('newsList', 'categories'));
    }

    public function show($news)
    {
        $news = News::findOrFail($news);

        $categories = Category::all();

        return view('news.news', compact('news', 'categories'));
    }
}
