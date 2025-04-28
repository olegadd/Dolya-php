<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($post) ? 'Edit Post' : 'Create Post' }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>{{ isset($post) ? 'Edit Post' : 'Create Post' }}</h1>
        <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST">
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? '') }}">
                @error('title')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Содержимое</label>
                <textarea name="content" id="content" rows="5">{{ old('content', $post->content ?? '') }}</textarea>
                @error('content')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Закрыть</a>
        </form>
    </div>
</body>
</html>
