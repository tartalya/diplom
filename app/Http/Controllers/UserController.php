<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;

class UserController extends Controller
    {

    public function ShowLoginForm()
        {
        return view('auth.login');
        }

    public function Auth()
        {

        if (!empty(Request::input('login')) && !empty(Request::input('password'))) {

            $result = \App\User::Auth(Request::input('login'), md5(Request::input('password')));

            if ($result) {

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

    public function Logout()
        {

        session_start();
        session_destroy();
        return redirect()->route('login');
        }

    }
