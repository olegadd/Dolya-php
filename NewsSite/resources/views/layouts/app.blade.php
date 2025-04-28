<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'NewsSite') }} - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('users.index') }}">Пользователи</a></li>
                <li><a href="{{ route('posts.index') }}">Посты</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} NewsSite</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
