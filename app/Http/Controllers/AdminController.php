<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Redirect;
use App\Faq;
use App\Admin;
use App\Categories;
use App\User;

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

        self::$baseContent = Admin::GetBaseInfo();
        self::$lastQuestions = Faq::LastQuestions();
        self::$categories = Categories::all();
        self::$statuses = Faq::GetStatusList();
        self::$questions = Faq::GetAll();
        self::$users = User::All();
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

                    User::destroy(Request::input('id'));
                    return Redirect::back()->with('msg', 'Пользователь удален');
                } else if (Request::input('id') == 1) {

                    return Redirect::back()->with('msg', 'Нельзя удалить супер администратора');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка удаления пользователя');
                }

                break;

            case 'edit':

                if (!empty(Request::input('id')) && !empty(Request::input('name')) && !empty(Request::input('login')) && !empty(Request::input('email'))) {

                    User::Edit(Request::input('id'), Request::input('name'), Request::input('login'), Request::input('email'), Request::input('password'));


                    return Redirect::back()->with('msg', 'Пользовательские данные успешно отредактированы');
                } else {


                    return Redirect::back()->with('msg', 'Поля Имя, Login и email не должны быть пустыми');
                }

                break;

            case 'add':


                if (!empty(Request::input('name')) && !empty(Request::input('login')) && !empty(Request::input('email')) && !empty(Request::input('password'))) {


                    User::firstOrCreate(array('name' => Request::input('name'), 'login' => Request::input('login'), 'email' => Request::input('email'), 'password' => md5(Request::input('password'))));

                    return Redirect::back()->with('msg', 'Пользователь успешно добавлен');
                } else {

                    return Redirect::back()->with('msg', 'Все поля обязательны для заполнения');
                }

                break;
        }
        }

    public function ShowAnswerPage()
        {

        $questions = Faq::GetAll(1);


        return view('admin.answer')->withContent(self::$baseContent)
                        ->withQuestions($questions)
                        ->withCategories(self::$categories)
                        ->withStatuses(self::$statuses)
                        ->withDescription('Список вопросов нуждающихся в ответе');
        }

    public function ShowManagePage()
        {

        return view('admin.answer')->withContent(self::$baseContent)
                        ->withQuestions(self::$questions)
                        ->withCategories(self::$categories)
                        ->withStatuses(self::$statuses)
                        ->withDescription('Список всех вопросов');
        }

    public function ManageAnswer()
        {

        switch (Request::input('action')) {

            case 'edit':

                if (!empty(Request::input('category')) && !empty(Request::input('status')) && !empty(Request::input('questioner_name')) && !empty(Request::input('questioner_email')) && !empty(Request::input('question')) && !empty(Request::input('answer')) && !empty(Request::input('id'))) {
                    Faq::UpdateQuestion(Request::input('id'), Request::input('category'), Request::input('status'), Request::input('questioner_name'), Request::input('questioner_email'), Request::input('question'), Request::input('answer'));
                    return Redirect::back()->with('msg', 'Вопрос успешно обновлен');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка обновления данных');
                }
                break;

            case 'delete':

                if (!empty(Request::input('id'))) {

                    Faq::RemoveQuestion(Request::input('id'));
                    return Redirect::back()->with('msg', 'Ворпос успешно удален');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка удаления вопроса');
                }

                break;
        }
        }

    public function ShowCategoriesPage()
        {

        return view('admin.categories')->withContent(self::$baseContent)
                        ->withCategories(self::$categories)
                        ->withDescription('Управление категориями');
        }

    public static function GetCount($category = '', $status = '')
        {

        return Faq::Count($category, $status);
        }

    public static function ShowAnswerByCategory()
        {

        if (Request::has('category_id') && !empty(Request::input('category_id'))) {


            $category_id = Request::input('category_id');
        } else {

            $category_id = Categories::select()->first()->id;
        }

        return view('admin.list')->withContent(self::$baseContent)
                        ->withQuestions(self::$questions)
                        ->withCategories(self::$categories)
                        ->withStatuses(self::$statuses)
                        ->withSelectedId($category_id)
                        ->withDescription('Список вопросов в категории');
        }

    }
