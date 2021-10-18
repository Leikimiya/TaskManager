<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $taskID=$this->route('task');//вычленяем id параметра маршрута {task}
        //извлекаем из базы задачу
        $task=Task::find($taskID);
        if (isset($task))
        {
            return $this->user()->can('update', $task);
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
         'title'=>['required', 'string','max:255'],
         'preview'=>['required', 'string','max:255'],
         'detail'=>['required', 'string','max:1000'],
         'status'=>['required','numeric','exists:statuses,id'],
            'mini'=>['array'],
            'mini.*'=>['string','max:255'],
            'file'=>['file','max:1024','image']
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Не заполено название задачи',
            'preview.required'=>'Не заполен анонc задачи',
            'detail.required'=>'Не заполен текст задачи',
            'status.required'=>'Не выбран статус задачи',
            'status.exists'=>'выбран неизвестный статус'

        ];
    }

}
