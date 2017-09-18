<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;

class AdminController extends Controller
    {

    private static $baseContent;
    private static $lastQuestions;

    public function __construct()
        {

        self::$baseContent = \App\Admin::GetBaseInfo();
        self::$lastQuestions = \App\Faq::LastQuestions();
        }

    public function ShowAdminPanel()
        {

        if (self::$baseContent && self::$lastQuestions) {
            return view('admin.main')->withContent(self::$baseContent)->withlastQuestions(self::$lastQuestions);
        } else {

            return redirect()->route('login');
            ;
        }
        }

    public function ManageUsers($msg = '')
        {

        if (self::$baseContent) {


            $users = \App\User::GetAll();

            return view('admin.edit')->withContent(self::$baseContent)->withUsers($users)->withMsg($msg);
        }
        }

    public function EditUser()
        {


        //var_dump($_POST);

        switch (Request::input('action')) {

            case 'delete':

                if (!empty(Request::input('id')) && Request::input('id') != 1) {

                    \App\User::Remove(Request::input('id'));
                    return redirect()->route('manageUsers');
                } else if (Request::input('id') == 1) {

                    return $this->ManageUsers('Нельзя удалить супер администратора');
                } else {

                    return $this->ManageUsers('Ошибка удаления пользователя');
                }

                break;

            case 'edit':

                if (!empty(Request::input('id')) && !empty(Request::input('name')) && !empty(Request::input('login')) && !empty(Request::input('email'))) {

                    \App\User::Edit(Request::input('id'), Request::input('name'), Request::input('login'), Request::input('email'), Request::input('password'));

                    return redirect()->route('manageUsers');
                } else {

                    return $this->ManageUsers('Поля Имя, Login и email не должны быть пустыми');
                }

                break;
                
            case 'add':
                
                
                if (!empty(Request::input('name')) && !empty(Request::input('login')) && !empty(Request::input('email')) && !empty(Request::input('password'))) {
                    
                    \App\User::Add(Request::input('name'), Request::input('login'), Request::input('email'), Request::input('password'));
                    return redirect()->route('manageUsers');
                
                } else {
                    
                    return $this->ManageUsers('Все поля обязательны для заполнения');
                }
                
                break;
        }
        }

    }
