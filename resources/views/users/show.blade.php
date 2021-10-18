@extends('layouts.main')
@section('title','Профиль пользователя')
@section('content')
    <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="Аватар пользователя">
        <div class="card-body">
            <h5 class="card-title">{{$user->lastname}} {{$user->name}}</h5>
            <p class="card-text">Дата рождения: {{$user->birth}}</p>
            <a href="{{route('tasks.index')}}" class="btn btn-dark">К моим задачам</a>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
