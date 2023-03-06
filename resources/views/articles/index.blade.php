@extends('layouts.app')

@isset($currentCategory)
    @section('title', $currentCategory->name)
@else
    @section('title', 'Новостная лента')
@endisset

@section('content')

        <h2 class="display-6 text-center mb-5 mt-5">
            @isset($currentCategory)
                {{ $currentCategory->name }}
            @else
                {{ __('Новостная лента') }}
            @endisset
        </h2>

            <div class="row mb-3">
                <div class="col-md-3 themed-grid-col"></div>
                <div class="col-md-6 themed-grid-col text-le">
                    <select class="form-select mb-4 categories" aria-label="Default select example">
                        <option value="0">
                            @isset($currentCategory)
                                {{ __('Все разделы') }}
                            @else
                                {{ __('Выберите раздел') }}
                            @endisset
                        </option>
                        @foreach($categories as $category)
                            <option @isset($currentCategory) @selected($currentCategory->slug == $category->slug) @endisset value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 themed-grid-col"></div>
            </div>

            @foreach($articles as $article)
                <div class="row mb-3">
                    <div class="col-md-3 themed-grid-col"></div>
                    <div class="col-md-6 themed-grid-col text-le">
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">{{ $article->categories->first()->name }}</strong>
                                <h3 class="mb-0">{{ $article->title }}</h3>
                                <div class="mb-1 text-muted">{{ $article->created_at->diffForHumans() }}</div>
                                <p class="card-text mb-auto">{{ $article->description }}</p>
                                <a href="{{ route('articles.show', $article->id) }}" class="stretched-link mt-4">{{ __('Подробнее') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 themed-grid-col"></div>
                </div>
            @endforeach

        <div class="text-center mt-3 justify-content-center d-flex">
            {{ $articles->links() }}
        </div>

@endsection


@push('js')

    <script type="module">
        $(document).ready(function(){
            $(".categories").click(function(){
                if ($(this).val() == '0') {
                    location.replace('{{ route('home') }}')
                } else {
                    location.replace('{{ route('categories.articles', '') }}/' + $(this).val())
                }
            });
        });
    </script>

@endpush
