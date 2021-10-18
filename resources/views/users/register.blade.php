@extends('layouts.main')
@section('title','Регистрация пользователя')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <form method="post" action="{{route('store')}}" >
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Имя пользователя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Фамилия</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Дата рождения</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="birth" name="birth" value="{{ old('birth') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Повторите пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password_confirmed" name="password_confirmation">
            </div>
        </div>
        <button type="submit" class="btn btn-dark">Зарегистрироваться</button>
        @csrf
    </form>
@endsection
@section('scripts')
    @parent
@endsection
