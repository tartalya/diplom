<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Redirect;

class AdminController extends Controller
    {

    private static $baseContent;
    private static $lastQuestions;
    private static $categories;
    private static $statuses;

    public function __construct()
        {

        self::$baseContent = \App\Admin::GetBaseInfo();
        self::$lastQuestions = \App\Faq::LastQuestions();
        self::$categories = \App\Categories::GetAll();
        self::$statuses = \App\Faq::GetStatusList();
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

    public function ShowAnswerPage($msg = '')
        {

        $questions = \App\Faq::GetAll(1);


        return view('admin.answer')->withContent(self::$baseContent)
                        ->withQuestions($questions)
                        ->withCategories(self::$categories)
                        ->withStatuses(self::$statuses)
                        ->withDescription('Список вопросов нуждающихся в ответе')
                        ->withMsg($msg);
        }

    public function ShowManagePage($msg = '')
        {

        $questions = \App\Faq::GetAll();


        return view('admin.answer')->withContent(self::$baseContent)
                        ->withQuestions($questions)
                        ->withCategories(self::$categories)
                        ->withStatuses(self::$statuses)
                        ->withDescription('Список всех вопросов')
                        ->withMsg($msg);
        }

    public function ManageAnswer()
        {

        //var_dump($_POST);

        switch (Request::input('action')) {

            case 'edit':

                if (!empty(Request::input('category')) && !empty(Request::input('status')) && !empty(Request::input('questioner_name')) && !empty(Request::input('questioner_email')) && !empty(Request::input('question')) && !empty(Request::input('answer')) && !empty(Request::input('id'))) {
                    \App\Faq::UpdateQuestion(Request::input('id'), Request::input('category'), Request::input('status'), Request::input('questioner_name'), Request::input('questioner_email'), Request::input('question'), Request::input('answer'));
                    return Redirect::back()->with('msg', 'Вопрос успешно обновлен');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка обновления данных');
                }
                break;

            case 'delete':

                if (!empty(Request::input('id'))) {

                    \App\Faq::RemoveQuestion(Request::input('id'));
                    return Redirect::back()->with('msg', 'Ворпос успешно удален');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка удаления вопроса');
                }

                break;
        }
        }

    }
