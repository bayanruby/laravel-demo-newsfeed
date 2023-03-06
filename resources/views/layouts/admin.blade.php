<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Admin') }} {{ config('app.name') }}</title>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    @stack('css')
</head>
<body>
<div class="container py-3 d-flex flex-column min-vh-100">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="{{ route('admin.home') }}" class="d-flex align-items-center text-dark text-decoration-none">
                <img class="me-2" src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="40" height="32">
                <span class="fs-4">{{ __('Admin') }} {{ config('app.name') }}</span>
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none {{ active_route(['admin.articles.*', 'admin.home']) }}" href="{{ route('admin.articles.index') }}">{{ __('Новости') }}</a>
                <a class="me-3 py-2 text-dark text-decoration-none {{ active_route(['admin.categories.*']) }}" href="{{ route('admin.categories.index') }}">{{ __('Категории') }}</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="{{ route('home') }}">{{ __('Go to') }} {{ config('app.name') }}</a>
            </nav>
        </div>
    </header>

    <main class="mb-5">

        @yield('content')

    </main>

    @include('includes.footer')
</div>

@stack('js')

</body>
</html>
