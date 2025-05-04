@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
            <h1>Список новостей</h1>
        </div>

        {{-- Кнопка создания поста видна админам и редакторам --}}
        <div class="col-md-6 text-end">
            @can('create-posts')
            <a href="{{ route('posts.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Создать новость
            </a>
            @endcan
        </div>
    </div>

    {{-- Вывод списка постов --}}
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ Str::limit($post->content, 200) }}</p>

                    {{-- Кнопки действий --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">
                            Читать далее
                        </a>

                        <div class="action-buttons">
                            {{-- Редактирование для админов и редакторов --}}
                            @can('edit-posts')
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-edit"></i> Редактировать
                            </a>
                            @endcan

                            {{-- Удаление только для админов --}}
                            @can('delete-posts')
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить эту новость?')">
                                    <i class="fas fa-trash"></i> Удалить
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Пагинация --}}
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
