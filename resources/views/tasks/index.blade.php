@extends('layouts.main')
@section('title','Список задач')

@section('content')
<div class="row">
    @foreach ($list as $item)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
        <div class="card mb-4 text-white bg-dark " style="width: 18rem;"  >
            @isset($item->file)
                <img class="task_image" width="150" height="150" src="{{asset($item->file->path)}}"  alt="...">
            @endisset
            <div class="card-body">
                <h5 class="card-title">{{$item->title}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Статус задачи: {{$item->status->name}}  </h6>
                <p class="card-text">{{$item->tpreview_text}}</p>
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('tasks.show',['task'=>$item->id])}}" class="btn btn-light">Подробнее</a>
                    </div>
                    <div class="col-6">
                    <form method="post" action="{{route('tasks.destroy',['task'=>$item->id])}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="d-grid gap-2">
    <a href="{{route('tasks.create')}}" class="btn btn-dark">Создать задачу</a>
</div>
@endsection

@section('scripts')
    @parent
@endsection
