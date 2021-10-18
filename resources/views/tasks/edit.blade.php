@extends('layouts.main')
@section('title','Редактирование задачи')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div class="card">
    <form method="post" action="{{route('tasks.update' ,['task' =>$task->id])}}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <input required class="form-control form-control-lg mb-2" id="title" name="title" type="text" value="{{$task->title}}" aria-label=".form-control-lg example">
        <div class="input-group mb-3">
            <select class="form-control-lg" id="statuses" name="status">
                @foreach ($status_list as $stl)
                    <option value="{{$stl->id}}" @if($stl->id===$task->status_id)selected @endif>{{$stl->name}} </option>
                @endforeach
            </select>
        </div>
        <input required class="form-control form-control-lg mb-2" id="preview" name="preview" type="text" value="{{$task->preview_text}}" aria-label=".form-control-lg example">
        <input required class="form-control form-control-lg mb-2" id="detail" name="detail" type="text" value="{{$task->detail_text}}" aria-label=".form-control-lg example">
        <ul id="mini-list">
        @foreach($task->minis as $mini)
            <li class="mb-3">
            <input required class="form-control form-control-lg mb-2" name="mini[]" type="text" value="{{$mini->title}}" aria-label=".form-control-lg example">
            </li>
        @endforeach
        </ul>
        <button id="add-mini" class="btn btn-dark" >+ добавить</button>
        <div class="mb-3">
            @isset($task->file)
            <img class="task_image" src="{{asset($task->file->path)}}" alt="">
            @endisset
            <label for="formFile" class="form-label">Заменить изображение</label>
            <input class="form-control" type="file" id="formFile" name="file">
        </div>
        <div class="mt-3">
        <button type="submit" class="btn btn-dark btn-sm">Сохранить</button>
        <a href="{{route('tasks.show',[$task->id])}}" class="btn btn-dark btn-sm">Отмена</a>
        </div>
    </form>
        <form method="post" action="{{route('tasks.destroy',['task'=>$task->id])}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
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
