<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends \Illuminate\Foundation\Auth\User
{
    use \Illuminate\Auth\Authenticatable, HasFactory;

    protected $table = 'users'; //на какую таблицу должна смотреть модель USER

    protected $fillable = ['name', 'email', 'lastname', 'birth', 'password'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}

//User:: create (['name'=>'вася','email'=>'vasya@mail.ru', 'password'=>'qwerty']) создание первой строоки пример
