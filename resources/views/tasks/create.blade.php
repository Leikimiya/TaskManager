@extends('layouts.main')
@section('title','Создание задачи')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div class="card">
    <form method="post" action="{{route('tasks.store')}}" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Название задачи</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Введите название">
        </div>
        <div class="mb-3">
            <label for="preview" class="form-label">Текст анонса задачи</label>
            <input type="text" class="form-control" id="preview" name="preview" placeholder="Текст анонса задачи">
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Текст  задачи</label>
            <textarea class="form-control" id="detail" name="detail" rows="10"></textarea>
        </div>
        <div class="mb-3">
            <label  class="form-label">Мини задача</label>
            <ul id="mini-list">
            </ul>
            <button id="add-mini" class="btn btn-success" >+ добавить</button>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Изображение</label>
            <input class="form-control" type="file" id="formFile" name="file">
        </div>
        <button type="submit" class="btn btn-dark  w-100">Создать задачу</button>
        @csrf
    </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $("#add-mini").on("click",function (event){
            event.preventDefault();
         $("#mini-list").append('<li class="mb-3"> <input type="text" name="mini[]" class="form-control"> </li>')
        });
    </script>
@endsection
