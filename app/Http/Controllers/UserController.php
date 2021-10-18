<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller

{
         public function register ()
         {
        return view('users.register');
         }


        public function store (UserRegisterRequest $request)
        {
            $data = $request->validated();


                $user = new User;
                $user->name = $data['name'];
                $user->lastname = $data['lastname'];
                $user->birth = $data['birth'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->save();

                Auth::login($user);//сразу авторизуем зарегестрированного пользователя пользователя
                return redirect(route('index'));


            //return redirect(route('authorization'));
        }

        public function authorization()
            {
                return view('users.authorization');
            }
        public function auth(UserAuthRequest $request )
        {
           $data=$request->validated();

          /* $user=User::select('id', 'password', 'email')
               ->where ('email', '=', $data['email'])
               //->where ('password', '=', $data['password'])

               ->first();
                if(!isset($user))
                {
               return back()->withErrors([
                   'message'=>'Неверный логин!'
               ]);
                }else {

                    if (!Hash::check($data['password'], $user->password)){
                        return back()->withErrors([
                            'message'=>'Неверный пароль!'
                        ]);
                    }
                }
*/
           if (!Auth::attempt([
                'email'=>$data['email'],
                'password'=>$data['password'],
            ],isset($data['remember']))){ //isset добавлет функцию запомнить
               return back()->withErrors([
                   'message'=>'Неверные данные!'
               ]);
            }

           return redirect((route('index')));
        }

        public function logout(Request $request)
        {
        Auth::logout();
        $request->session()->invalidate();//чистим данные пользователя
        $request->session()->regenerateToken();//удоляем токен
            return redirect(route('authorization'));
        }

        public function show()
        {

            $user= User::select('id','name','lastname','birth', 'email')->find(Auth::id());

            return view('users.show',['user'=>$user]);
        }














}
