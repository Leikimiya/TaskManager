@extends('layouts.main')
@section('title','Задача ')

@section('content')
    <div class="card text-white bg-dark">
        <h5 class="card-header">{{$task->title}}</h5>
        <div class="card-body">
            <h5 class="card-title">Статус задачи: {{$status->name}}</h5>
            <p class="card-text">{{$task->detail_text}}</p>
            <p>Доп.задачи:</p>
            <ul>
            @forelse($task->minis as $mini)
            <li>{{$mini->title}}</li>
                @empty
                    <li>Доп. задач-нет</li>
            @endforelse
                @isset($task->file)
                    <img class="task_image" src="{{asset($task->file->path)}}" alt="">
                @endisset
            </ul>
            <a href="{{route('tasks.edit',['task'=>$task->id])}}" class="btn btn-light">Редактировать</a>
            <a href="{{route('tasks.index')}}" class="btn btn-light">К списку задач</a>
        </div>
        <form method="post" action="{{route('tasks.destroy',['task'=>$task->id])}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
