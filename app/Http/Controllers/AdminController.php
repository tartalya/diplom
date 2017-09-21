<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use App\Faq;
use App\Categories;
use App\User;
use App\Status;

class AdminController extends Controller
    {

    private static $baseContent;
    private static $categories;
    private static $statuses;
    private static $questions;

    public function __construct()
        {

        self::$baseContent = Self::getBaseInfo();
        self::$categories = Categories::all();
        self::$statuses = Status::all();
        self::$questions = Faq::getAll();
        }

    public static function getBaseInfo()
        {

        session_start();

        //$test = Faq::find(3)->status;
        
        //dd($test);
        
        
        if ($_SESSION) {

            $content['admin_name'] = $_SESSION['name'];
            $content['admin_count'] = User::select()->count();
            $content['qa_count'] = Faq::select()->count();
            $content['categories_count'] = Categories::select()->count();
            $content['not_answered_count'] = Faq::where('status_id', 1)->count();

            return $content;
        }
        }

    public function showAdminPanel()
        {

        if ($_SESSION) {
            
            $lastQuestion = Faq::join('categories', 'faqs.category_id', '=', 'categories.id')
                ->select('faqs.*', 'categories.category_name')
                    ->orderBy('id', 'DESC')->take(15)
                ->get();

            return view('admin.main')->withContent(self::$baseContent)->withlastQuestions($lastQuestion);
        } else {

            return redirect()->route('login');
        }
        }

    public function manageUsers()
        {

        return view('admin.edit')->withContent(self::$baseContent)->withUsers(User::all());
        }

    public function editUser()
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

    public function showAnswerPage()
        {

        $questions = Faq::GetAll(1);
        
        /*
        $questions = Faq::join('categories', 'faqs.category_id', '=', 'categories.id')
                ->join('statuses', 'faqs.status_id', '=', 'statuses.id')
                ->select('faqs.*', 'categories.category_name', 'statuses.status_name')
                ->where('faqs.status_id', 1)
                ->get();
*/

        return view('admin.answer')->withContent(self::$baseContent)
                        ->withQuestions($questions)
                        ->withCategories(self::$categories)
                        ->withStatuses(self::$statuses)
                        ->withDescription('Список вопросов нуждающихся в ответе');
        }

    public function showManagePage()
        {

        return view('admin.answer')->withContent(self::$baseContent)
                        ->withQuestions(self::$questions)
                        ->withCategories(self::$categories)
                        ->withStatuses(self::$statuses)
                        ->withDescription('Список всех вопросов');
        }

    public function manageAnswer()
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

                    Faq::where('id', $id)->destroy();

                    return Redirect::back()->with('msg', 'Ворпос успешно удален');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка удаления вопроса');
                }

                break;
        }
        }

    public function showCategoriesPage()
        {

        return view('admin.categories')->withContent(self::$baseContent)
                        ->withCategories(self::$categories)
                        ->withDescription('Управление категориями');
        }

    public static function GetCount($category = '', $status = '')
        {

        return Faq::Count($category, $status);
        }

    public static function showAnswerByCategory()
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
