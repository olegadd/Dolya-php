@extends('layouts.app')

     @section('content')
         <div class="container">
             <h1>{{ isset($post) ? 'Редактировать пост' : 'Создать пост' }}</h1>

             <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 @if(isset($post))
                     @method('PUT')
                 @endif

                 <div class="form-group">
                     <label for="title">Заголовок</label>
                     <input type="text" name="title" id="title" value="{{ old('title', isset($post) ? $post->title : '') }}" class="form-control">
                     @error('title')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="form-group">
                     <label for="featured_image">Фото</label>
                     <input type="file" name="featured_image" id="featured_image" accept="image/*" class="form-control-file">
                     @error('featured_image')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="form-group">
                     <label for="content">Содержание</label>
                     <textarea name="content" id="content" class="form-control">{{ old('content', isset($post) ? $post->content : '') }}</textarea>
                     @error('content')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <button type="submit" class="btn btn-primary">Сохранить</button>
                 <a href="{{ route('posts.index') }}" class="btn btn-secondary">Отмена</a>
             </form>
         </div>
     @endsection
