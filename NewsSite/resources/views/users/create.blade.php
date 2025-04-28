<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($user) ? 'Edit User' : 'Create User' }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>
        <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
            @csrf
            @if (isset($user))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}">
                @error('name')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}">
                @error('email')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Подтвердить пароль</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Закрыть</a>
        </form>
    </div>
</body>
</html>
