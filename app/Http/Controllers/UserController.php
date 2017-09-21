<?php

namespace App\Http\Controllers;

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
