<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">

    <title>@yield('title')</title>
</head>
<body>
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('index')}}">Меню</a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @auth
                <li class="nav-item">
                    <a class="nav-link " href="{{route('index')}}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tasks.index')}}">Мои задачи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tasks.create')}}">Создать задачу</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('trash')}}">Удаленные задачи</a>
                    </li>
                <li class="nav-item user">
                    <a class="nav-link" href="{{route('show')}}">{{Auth::user()->name}}</a>
                </li>
                    <li class="nav-item exit">
                        <a class="nav-link" href="{{route('exit')}}">Выход</a>
                    </li>
                    </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('authorization')}}">Войти</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container">
{{--{{Auth::user()}}--}}
@yield('content')
</div>
@section('scripts')
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@show
</body>
</html>
