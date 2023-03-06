@extends('layouts.admin')

@section('content')

    <h2 class="display-6 text-center mb-5 mt-5">{{ __('Управление категориями') }}</h2>

    <div class="row mb-4">
        <div class="col-md-3 themed-grid-col"></div>
        <div class="col-md-6 themed-grid-col text-le">
            <form class="mt-4">
                <a class="btn btn-primary" href="{{ route('admin.categories.create') }}" role="button">{{ __('+ Добавить категорию') }}</a>
            </form>
        </div>
        <div class="col-md-3 themed-grid-col"></div>
    </div>

    @foreach($categories as $k => $category)
        <div class="row mb-3 @if(! $category->is_active) opacity-50 @endif">
            <div class="col-md-3 themed-grid-col"></div>
            <div class="col-md-6 themed-grid-col text-le">
                @if(session('status') && !$k)
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0">{{ $category->name }}</h3>
                        <div class="mb-1 text-muted">{{ route('categories.articles', $category->slug, false) }}</div>

                        @if($category->is_active)
                            <form class="mt-4" action="{{ route('admin.categories.archive', $category->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <a class="btn btn-outline-primary" href="{{ route('admin.categories.edit', $category->id) }}" role="button">{{ __('Редактировать') }}</a>
                                <button type="submit" class="btn btn-link link-danger archive">
                                    {{ __('Скрыть') }}
                                </button>
                            </form>
                        @else
                            <form class="mt-4" action="{{ route('admin.categories.unarchive', $category->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <a class="btn btn-outline-primary" href="{{ route('admin.categories.edit', $category->id) }}" role="button">{{ __('Редактировать') }}</a>
                                <button type="submit" class="btn btn-link link-danger unarchive">
                                    {{ __('Восстановить') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3 themed-grid-col"></div>
        </div>
    @endforeach

@endsection


@push('js')

    <script type="module">
        $(document).ready(function(){
            $('form .link-danger.archive').on('click', function (){
                var result = confirm("{{ __('Скрыть категорию?') }}");
                if (!result) {
                    return false;
                }
            })

            $('form .link-danger.unarchive').on('click', function (){
                var result = confirm("{{ __('Восстановить категорию?') }}");
                if (!result) {
                    return false;
                }
            })
        });
    </script>

@endpush
