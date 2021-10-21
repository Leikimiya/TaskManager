@extends('layouts.main')
@section('title','Удаленные задачи')
@section('content')
    @foreach ($list as $item)
    <div class="card text-white bg-dark">
        <div class="card-body row">
            <div class="col-4 m-2">
                  <h5 class="card-title"> {{$item->title}}</h5>
            </div>
            <div>
            <div class="col-4 m-2 ">
                <form method="post" action="{{route('restore',['task'=>$item->id])}}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Восстановить</button>
                </form>
            </div>
            <div class="col-4 m-2">
                <form method="post" action="{{route('tasks.destroy',['task'=>$item->id])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
            </div>
        </div>
    </div>
        @endforeach
@endsection
@section('scripts')
    @parent
@endsection
