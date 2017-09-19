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
    private static $questions;
    private static $users;

    public function __construct()
        {

        self::$baseContent = \App\Admin::GetBaseInfo();
        self::$lastQuestions = \App\Faq::LastQuestions();
        self::$categories = \App\Categories::GetAll();
        self::$statuses = \App\Faq::GetStatusList();
        self::$questions = \App\Faq::GetAll();
        self::$users = \App\User::GetAll();
        }

    public function ShowAdminPanel()
        {

        if ($_SESSION) {

            return view('admin.main')->withContent(self::$baseContent)->withlastQuestions(self::$lastQuestions);
        } else {

            return redirect()->route('login');
        }
        }

    public function ManageUsers()
        {

        return view('admin.edit')->withContent(self::$baseContent)->withUsers(self::$users);
        }

    public function EditUser()
        {

        switch (Request::input('action')) {

            case 'delete':

                if (!empty(Request::input('id')) && Request::input('id') != 1) {

                    \App\User::Remove(Request::input('id'));
                    return Redirect::back()->with('msg', 'Пользователь удален');
                } else if (Request::input('id') == 1) {

                    return Redirect::back()->with('msg', 'Нельзя удалить супер администратора');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка удаления пользователя');
                }

                break;

            case 'edit':

                if (!empty(Request::input('id')) && !empty(Request::input('name')) && !empty(Request::input('login')) && !empty(Request::input('email'))) {

                    \App\User::Edit(Request::input('id'), Request::input('name'), Request::input('login'), Request::input('email'), Request::input('password'));


                    return Redirect::back()->with('msg', 'Пользовательские данные успешно отредактированы');
                } else {


                    return Redirect::back()->with('msg', 'Поля Имя, Login и email не должны быть пустыми');
                }

                break;

            case 'add':


                if (!empty(Request::input('name')) && !empty(Request::input('login')) && !empty(Request::input('email')) && !empty(Request::input('password'))) {

                    \App\User::Add(Request::input('name'), Request::input('login'), Request::input('email'), Request::input('password'));

                    return Redirect::back()->with('msg', 'Пользователь успешно добавлен');
                } else {


                    return Redirect::back()->with('msg', 'Все поля обязательны для заполнения');
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

        return view('admin.answer')->withContent(self::$baseContent)
                        ->withQuestions(self::$questions)
                        ->withCategories(self::$categories)
                        ->withStatuses(self::$statuses)
                        ->withDescription('Список всех вопросов')
                        ->withMsg($msg);
        }

    public function ManageAnswer()
        {

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

    public function ShowCategoriesPage($msg = '')
        {

        return view('admin.categories')->withContent(self::$baseContent)
                        ->withCategories(self::$categories)
                        ->withDescription('Управление категориями')
                        ->withMsg($msg);
        }

    public static function GetCount($category = '', $status = '')
        {

        return \App\Faq::Count($category, $status);
        }

    public static function ShowAnswerByCategory()
        {

        if (Request::has('category_id') && !empty(Request::input('category_id'))) {


            $category_id = Request::input('category_id');
        } else {

            $category_id = \App\Categories::GetFirstId();
        }

        return view('admin.list')->withContent(self::$baseContent)
                        ->withQuestions(self::$questions)
                        ->withCategories(self::$categories)
                        ->withStatuses(self::$statuses)
                        ->withSelectedId($category_id)
                        ->withDescription('Список вопросов в категории');
        }

    }
