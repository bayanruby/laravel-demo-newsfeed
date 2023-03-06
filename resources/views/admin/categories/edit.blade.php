@extends('layouts.admin')

@section('content')

    <h2 class="display-6 text-center mb-5 mt-5">{{ __('Ваша категория') }}</h2>

    <div class="row mb-3">
        <div class="col-md-3 themed-grid-col"></div>
        <div class="col-md-6 themed-grid-col text-le">

            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">{{ __('Название') }}</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="title" value="{{ old('name', $category->name) }}" autofocus>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label fw-bold">{{ __('Slug') }}</label>
                    <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" id="title" value="{{ old('slug', $category->slug) }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @else
                        <div id="passwordHelpBlock" class="form-text">
                            {{ __('Уникальный фрагмент URL-адреса') }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                <a class="btn btn-link" href="{{ route('admin.categories.index') }}" role="button">{{ __('Отменить') }}</a>
            </form>

        </div>
        <div class="col-md-3 themed-grid-col"></div>
    </div>

@endsection('content')
