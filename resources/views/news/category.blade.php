@extends('layouts.app')

@section('title', $newsList->first()->categories()->first()->name)

@section('content')

        <h2 class="display-6 text-center mb-5 mt-5">{{ $newsList->first()->categories()->first()->name }}</h2>

        <div class="row mb-3">
            <div class="col-md-3 themed-grid-col"></div>
            <div class="col-md-6 themed-grid-col text-le">
                <select class="form-select mb-4 categories" aria-label="Default select example">
                    @foreach($categories as $category)
                        <option @isset($slug) @selected($slug == $category->slug) @endisset value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 themed-grid-col"></div>
        </div>

        @foreach($newsList as $news)
            <div class="row mb-3">
                <div class="col-md-3 themed-grid-col"></div>
                <div class="col-md-6 themed-grid-col text-le">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">{{ $news->categories()->first()->name }}</strong>
                            <h3 class="mb-0">{{ $news->title }}</h3>
                            <div class="mb-1 text-muted">{{ $news->created_at->diffForHumans() }}</div>
                            <p class="card-text mb-auto">{{ $news->description }}</p>
                            <a href="{{ route('news.news', $news->id) }}" class="stretched-link">{{ __('Подробнее') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 themed-grid-col"></div>
            </div>
        @endforeach

        <div class="text-center mt-3 justify-content-center d-flex">
            {{ $newsList->links() }}
        </div>

@endsection
