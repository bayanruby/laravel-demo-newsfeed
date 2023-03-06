<?php

/** @var $router Illuminate\Routing\Router */

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;

$router->get('/', [ArticleController::class, 'index'])->name('home');
$router->get('/news', [ArticleController::class, 'index'])->name('articles.index');
$router->get('/news/{article}', [ArticleController::class, 'show'])->name('articles.show');

$router->get('/rubrics/{slug}', [CategoryController::class, 'articles'])->name('categories.articles');
