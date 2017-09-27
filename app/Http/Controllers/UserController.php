<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Request;

class UserController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function auth()
    {

        if (!empty(Request::input('login')) && !empty(Request::input('password'))) {

            $result = Auth::attempt(['login' => Request::input('login'), 'password' => Request::input('password')], 33600);

            if ($result) {

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
        Auth::logout();
        return redirect()->route('login');
    }
}
