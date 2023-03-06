@extends('layouts.admin')

@section('content')

    <h2 class="display-6 text-center mb-5 mt-5">
        @isset($currentCategory)
            {{ $currentCategory->name }}
        @else
            {{ __('Управление новостной лентой') }}
        @endisset
    </h2>

    <div class="row mb-3">
        <div class="col-md-3 themed-grid-col"></div>
        <div class="col-md-6 themed-grid-col text-le">
            <select class="form-select mb-4 categories">
                <option value="0">{{ __('Выберите раздел') }}</option>
                @foreach($categories as $category)
                    <option @isset($currentCategory) @selected($currentCategory->slug == $category->slug) @endisset value="{{ $category->slug }}">
                        @if($category->is_active)
                            {{ $category->name }}
                        @else
                            {{ $category->name }} ({{ __('в архиве') }})
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 themed-grid-col"></div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 themed-grid-col"></div>
        <div class="col-md-6 themed-grid-col text-le">
            <form class="mt-4">
                <a class="btn btn-primary" href="{{ route('admin.articles.create') }}" role="button">{{ __('+ Добавить новость') }}</a>
            </form>
        </div>
        <div class="col-md-3 themed-grid-col"></div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3 themed-grid-col"></div>
        <div class="col-md-6 themed-grid-col text-le">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="col-md-3 themed-grid-col"></div>
    </div>

    @foreach($articles as $k => $article)
        <div class="row mb-3">
            <div class="col-md-3 themed-grid-col"></div>
            <div class="col-md-6 themed-grid-col text-le">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">{{ $article->categories->first()->name }}</strong>
                        <h3 class="mb-0">{{ $article->title }}</h3>
                        <div class="mb-1 text-muted">{{ $article->created_at->diffForHumans() }}</div>
                        <p class="card-text mb-auto">{{ $article->description }}</p>

                        <form class="mt-4" action="{{ route('admin.articles.destroy', $article->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <a class="btn btn-outline-primary" href="{{ route('admin.articles.edit', $article->id) }}" role="button">{{ __('Редактировать') }}</a>
                            <button type="submit" class="btn btn-link link-danger">{{ __('Удалить') }}</button>
                        </form>
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
                    location.replace('{{ route('admin.articles.index') }}')
                } else {
                    location.replace('{{ route('admin.categories.articles', '') }}/' + $(this).val())
                }
            });

            $('form .link-danger').on('click', function (){
                var result = confirm("{{ __('Удалить новость?') }}");
                if (!result) {
                    return false;
                }
            })
        });
    </script>

@endpush
