@extends('layouts.admin')

@section('content')

        <h2 class="display-6 text-center mb-5 mt-5">{{ __('Ваша новость') }}</h2>

        <div class="row mb-3">
            <div class="col-md-3 themed-grid-col"></div>
            <div class="col-md-6 themed-grid-col text-le">

                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('admin.articles.update', $article->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">{{ __('Заголовок') }}</label>
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $article->title) }}" autofocus>
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label fw-bold">{{ __('Категория') }}</label>
                        <select name="category" class="form-select mb-1 @error('category') is-invalid @enderror" aria-label="Default select example">
                            <label for="category" class="form-label fw-bold">{{ __('Категория') }}</label>
                            @if(!$article->categories->first()->is_active)
                                <option selected value="{{ $article->categories->first()->id }}">
                                    {{ $article->categories->first()->name }} ({{ __('в архиве') }})
                                </option>
                            @endif

                            @foreach($categories as $category)
                                <option @selected(old('category', $article->categories->first()->id) == $category->id) value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">{{ __('Краткое содержание') }}</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $article->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label fw-bold">{{ __('Новость') }}</label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="15">{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    <a class="btn btn-link" href="{{ route('admin.articles.index') }}" role="button">{{ __('Отменить') }}</a>
                </form>

            </div>
            <div class="col-md-3 themed-grid-col"></div>
        </div>

@endsection('content')
