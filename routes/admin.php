<?php

/** @var $router Illuminate\Routing\Router */

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;

$router->controller(ArticleController::class)->group(function () use ($router) {
    $router->get('/', 'index')->name('home');
    $router->get('/news', 'index')->name('articles.index');
    $router->get('/news/{article}/edit', 'edit')->name('articles.edit');
    $router->put('/news/{article}', 'update')->name('articles.update');
    $router->get('/news/create', 'create')->name('articles.create');
    $router->post('/news', 'store')->name('articles.store');
    $router->delete('/news/{article}', 'destroy')->name('articles.destroy');
});

$router->controller(CategoryController::class)->group(function () use ($router) {
    $router->get('/categories', 'index')->name('categories.index');
    $router->get('/categories/create', 'create')->name('categories.create');
    $router->post('/categories', 'store')->name('categories.store');
    $router->get('/categories/{category}/edit', 'edit')->name('categories.edit');
    $router->put('/categories/{category}', 'update')->name('categories.update');
    $router->delete('/categories/{category}', 'destroy')->name('categories.destroy');
    $router->get('/rubrics/{slug}', 'articles')->name('categories.articles');
});
