<?php

/** @var $router Illuminate\Routing\Router */

use Illuminate\Http\Request;

$router->middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
