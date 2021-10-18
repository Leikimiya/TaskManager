<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\File;
use App\Models\Mini;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
 {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->get();

        return view('tasks.index',
        ['list'=>$tasks]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('tasks.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {

        $data = $request->validated();
         //$task = new Task();
        //$task->title = $data['title'];
        //$task->preview_text = $data['preview'];
        //$task->detail_text = $data['detail'];
        //$task->status_id=1;
       //$task->save();


        //получение обьекта статуса "Новая"
        $status=Status::find(1);

        $task=$status->tasks()->create([
            'title'=> $data['title'],
            'preview_text'=> $data['preview'],
            'detail_text'=> $data['detail']

        ]);
        $task->users()->attach (Auth::id());
        //привязать мини задачи
        if(isset($data['mini']))
        {
            foreach ($data['mini'] as $mini) {
                if (strlen($mini) > 0) {
                    $miniModel = new Mini();
                    $miniModel->title = $mini;
                    $miniModel->task_id = $task->id;
                    $miniModel->save();
                }
            }
        }
        //привязка файла
        //сохраняем файл в папке images
        if(isset($data['file']))
        {
            $path = $data['file']->store('images');
            $file = new File();
            $file->task_id = $task->id;
            $file->path = $path;
            $file->name = $data['file']->getClientOriginalName();
            $file->mime = $data['file']->getClientMimeType();
            $file->save();
        }
        return redirect(route('tasks.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task= Task::select('id','title','detail_text','status_id')->find($id);
        $status= $task->status;

        if(Auth::user()->can('view',$task))
        {
            return view('tasks.show', ['task' => $task, 'status' => $status]);
        }else
        {
            return redirect(route('tasks.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $task = Task::select('id', 'title','preview_text','detail_text','status_id')->find($id);//Task::fid(id);
        $status= $task->status;
        $status_list=Status::select('id','name')->get();;
        if(Auth::user()->can('update',$task))
        {
            return view('tasks.edit',['task'=>$task,'status'=>$status,'status_list'=>$status_list]);
        }else
        {
            return redirect(route('tasks.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        $data=$request->validated();//собрали все данные с формы
        $task = Task::find($id);// получили необходимую задачу из базы которую будем редактировать
        $task->title = $data['title'];//внесение параметров
        $task->preview_text = $data['preview'];//внесение параметров
        $task->detail_text = $data['detail'];//внесение параметров
        $task->status_id=$data['status'];//внесение параметров
        $task->save();//сохранение результатов

        if (isset($data['mini']))
        {
        $task->minis()->delete();//удаляем все мини задачи для текущей задачи

        foreach ($data['mini'] as $mini)
        {
            if (strlen($mini)> 0)
            {
                $miniModel= new Mini();
                $miniModel->title =$mini;
                $miniModel->task_id=$task->id;
                $miniModel->save();
            }
        }
        }
        // если фаил был загружен с формы
        if(isset($data['file']))
        {   //сохраняем полуенный фаил с формы
            $path = $data['file']->store('images');
            //получим текущий фаил, который был привязан к данной задаче
            $file=$task->file;
            //если у текущей задачи не был привязан старый фаил.
            if(!isset($file))
            {
                //создаем новы йфаил
                $file = new File();
                $file->task_id = $task->id;
            }
                $file->path = $path;
                $file->name = $data['file']->getClientOriginalName();
                $file->mime = $data['file']->getClientMimeType();
                $file->save();
        }
       return redirect(route('tasks.show',['task'=>$id]));//редирект на страницу с детальны описанием задачи которую редактировали
    }

    /**+++++++
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::withTrashed()->find($id);//получаем задачу из базы
        if($task->trashed())//если задача удалена ранее то
        {
            $task->minis()->delete();//удаляем все мини задачи для текущей задачи
            $task->file()->delete();//удаляем все файлы задачи для текущей задачи
            $task->users()->detach();//отвязываем пользователей от задачи
            $task->forceDelete();//удаляем  задачу
            return redirect(route('trash'));
        }
        else
        {
            $task->delete();//удаляем  задачу
            return redirect(route('tasks.index'));
        }

    }
    public function trash()
    {
        $tasks = Auth::user()->tasks()->onlyTrashed()->get();

        return view('tasks.trash',
            ['list'=>$tasks]
        );
    }
    public function restore($id)
    {

        $task=Task::withTrashed()->find($id);
        $task->restore();
        return redirect(route('trash'));
    }

}

