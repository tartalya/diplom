<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Request;
use App\User;

class UserController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function auth()
    {

        if (!empty(Request::input('login')) && !empty(Request::input('password'))) {

            $result = User::where('login', Request::input('login'))->where('password', md5(Request::input('password')))->first();



            if ($result) {

                //echo Auth::attempt(['login' => Request::input('login'), 'password' => md5(Request::input('password'))]);

                //echo Auth::loginUsingId(User::where('login', Request::input('login'))->first()->id);
                
                //echo Auth::loginUsingId(1);
                

                session_start();

                $_SESSION['name'] = $result->name;
                $_SESSION['email'] = $result->email;

                return redirect()->route('admin');
            } else {

                return view('auth.login')->withMsg('Ошибка авторизации');
            }
        } else {

            return view('auth.login')->withMsg('Нужно заполнить все поля');
        }
    }

    public function logout()
    {

        session_start();
        session_destroy();
        return redirect()->route('login');
    }
}
