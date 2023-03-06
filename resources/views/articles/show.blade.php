@extends('layouts.app')

@section('title', $article->title)

@section('content')

        <h2 class="display-6 text-center mb-5 mt-5"> </h2>

        <div class="row mb-3">
            <div class="col-md-3 themed-grid-col"></div>
            <div class="col-md-6 themed-grid-col text-le">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Главное') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.articles', $article->categories->first()->slug) }}">{{ $article->categories->first()->name }}</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3 themed-grid-col"></div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3 themed-grid-col"></div>
            <div class="col-md-6 themed-grid-col text-le">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0">{{ $article->title }}</h3>
                        <div class="mb-1 text-muted">{{ $article->created_at->diffForHumans() }}</div>
                        <p class="card-text mb-auto" style="white-space: pre-line;">{{ $article->content }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 themed-grid-col"></div>
        </div>

@endsection('content')


@push('js')

    <script type="module">
        $(document).ready(function(){
            $("header nav a[href='{{ route('categories.articles', $article->categories->first()->slug) }}']").addClass('active')
        });
    </script>

@endpush
