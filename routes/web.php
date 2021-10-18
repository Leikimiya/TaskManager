<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

///Route::get('/', function () {
    //return view('index');
///});

Route::get('/',[IndexController::class,'index'])->name('index');
//Таск-менеджер Маршруты
// 1. Добовление задачи POST-запрос /task/create
// 1.1 Вывод страницы с формой добовления задачи GET-запрос /task/create
// 2. Изменение контента задачи PUT-запрос /task/update{id}
// 2.1 Вывод страницы с формой изменения контента текущей задачи GET-запрос  /task/update{id}
// 3. Удаление текущей задачи DELETE-запрос /task/delete/{id}
// 4. Список задач GET-запрос /tasks
// 5. Детальный просмотр текущей задачи GET-запрос /task{id}
// 6. Авторизация и регистрация

// 1.
/*Route::post('/task/create',[TaskController::class, 'store'])->name('store');

// 1.1
Route::get('/task/create',[TaskController::class, 'create'])->name('create');

//2.
Route::put('/task/update{id}',[TaskController::class, 'update'])->name('update');

// 2.1
Route::get('/task/update{id}',[TaskController::class, 'getUpdate'])->name('getUpdate');

// 3
Route::delete('/task/delete/{id}', [TaskController::class, 'destroy'])->name('destroy');

// 4.
Route::get('/tasks',[TaskController::class, 'index'])->name('list');

// 5.
Route::get('/task{id}',[TaskController::class, 'show'])->name('show');
*/
Route::resource('tasks',TaskController::class)->middleware('auth');//auth
Route::get('/trash',[TaskController::class,'trash'])->name('trash');
Route::put('/restore/{task}',[TaskController::class,'restore'])->name('restore');

//необходим маршрут на главную страницу
//1. Создать маршрут  Route::get, указывает здесь корневую ссылку и новый контроллер IndexController
//2. Создаем сам контроллер php artisan make:controller WelcomeController
// IndexController
//3. В методе контроллера IndexContoller делаем  вывод  View с главной страницей
//4. создаем index.blade.php в папке  resourses/views
Route::middleware('guest')->group(function()
{
Route::get('/register',[\App\Http\Controllers\UserController::class,'register'])->name('register');
Route::post('/register',[\App\Http\Controllers\UserController::class,'store'])->name('store');
//Route::put('/register',[\App\Http\Controllers\UserController::class,'update'])->name('update');
Route::get('/login',[\App\Http\Controllers\UserController::class,'authorization'])->name('authorization');
Route::post('/login',[\App\Http\Controllers\UserController::class,'auth'])->name('authUser');
});
Route::get('/logout',[\App\Http\Controllers\UserController::class,'logout'])->name('exit')->middleware('auth');//auth
Route::get('/user',[\App\Http\Controllers\UserController::class, 'show'])->name('show')->middleware('auth');//auth





