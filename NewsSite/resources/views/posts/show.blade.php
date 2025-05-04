@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            {{-- Карточка поста --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    <div class="text-muted mb-3">
                        Опубликовано: {{ $post->created_at->format('d.m.Y H:i') }}
                        @if($post->updated_at != $post->created_at)
                            (Обновлено: {{ $post->updated_at->format('d.m.Y H:i') }})
                        @endif
                    </div>
                    <div class="post-content">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    {{-- Кнопки управления для админов и редакторов --}}
                    @canany(['edit-posts', 'delete-posts'])
                    <div class="mt-4 border-top pt-3">
                        @can('edit-posts')
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit"></i> Редактировать
                        </a>
                        @endcan

                        @can('delete-posts')
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Удалить эту новость?')">
                                <i class="fas fa-trash"></i> Удалить
                            </button>
                        </form>
                        @endcan
                    </div>
                    @endcanany
                </div>
            </div>

            {{-- Комментарии --}}
            <div class="card">
                <div class="card-header">
                    <h3>Комментарии ({{ $post->comments->count() }})</h3>
                </div>
                <div class="card-body">
                    {{-- Форма добавления комментария для авторизованных --}}
                    @auth
                        @can('add-comments')
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="form-group">
                                <textarea name="text" class="form-control" rows="3" placeholder="Ваш комментарий..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Отправить</button>
                        </form>
                        @endcan
                    @else
                        <p class="text-center">
                            <a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий
                        </p>
                    @endauth

                    {{-- Список комментариев --}}
                    @foreach($post->comments as $comment)
                    <div class="media mb-3">
                        <div class="media-body">
                            <h5 class="mt-0">{{ $comment->user->name }}</h5>
                            <p>{{ $comment->text }}</p>
                            <small class="text-muted">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
