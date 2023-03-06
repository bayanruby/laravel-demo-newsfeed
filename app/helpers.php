<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('active_url')) {

    function active_url(string $url, string $active = 'active'): string
    {
        return url()->current() == $url ? $active : '';
    }

}

if (!function_exists('active_route')) {

    function active_route(array $patterns, string $active = 'active'): string
    {
        return Route::is($patterns) ? $active : '';
    }

}
