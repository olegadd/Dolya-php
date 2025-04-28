@extends('layouts.app')

     @section('content')
         <div class="container">
             <h1>{{ $post->title }}</h1>
             <p>Автор: {{ $post->user ? $post->user->name : 'Гость' }}</p>

             @if($post->hasMedia('featured_image'))
                 <img src="{{ $post->getFirstMediaUrl('featured_image') }}" alt="{{ $post->title }}" class="img-fluid mb-3" style="max-width: 100%;">
             @endif

             <p>{{ $post->content }}</p>

             <a href="{{ route('posts.index') }}" class="btn btn-secondary">Назад</a>

             <h2>Комментарии</h2>
             @foreach($post->comments as $comment)
                 <div class="card mb-2">
                     <div class="card-body">
                         <p>{{ $comment->content }}</p>
                         <p>Автор: {{ $comment->user ? $comment->user->name : 'Гость' }}</p>
                     </div>
                 </div>
             @endforeach

             <h3>Добавить комментарий</h3>
             <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                 @csrf
                 <div class="form-group">
                     <textarea name="content" class="form-control" required></textarea>
                     @error('content')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>
                 <button type="submit" class="btn btn-primary">Добавить</button>
             </form>
         </div>
     @endsection
