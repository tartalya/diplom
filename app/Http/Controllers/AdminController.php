<?php
namespace App\Http\Controllers;

use Request;
use Redirect;
use App\Faq;
use App\Category;
use App\User;
use App\Status;
use App\Log;

class AdminController extends Controller
{

    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['name'])) {

            Redirect::to('login')->send();
        }
    }

    public static function getBaseInfo()
    {
        $content['admin_name'] = $_SESSION['name'];
        $content['admin_count'] = User::all()->count();
        $content['qa_count'] = Faq::all()->count();
        $content['categories_count'] = Category::all()->count();
        $content['not_answered_count'] = Faq::where('status_id', 1)->count();

        return $content;
    }

    public function showAdminPanel()
    {
        $lastQuestion = Faq::orderBy('id', 'DESC')->take(15)->get();

        return view('admin.main')->withContent(self::getBaseInfo())->withlastQuestions($lastQuestion);
    }

    public function manageUsers()
    {

        return view('admin.edit')->withContent(self::getBaseInfo())->withUsers(User::all());
    }

    public function editUser()
    {

        switch (Request::input('action')) {

            case 'delete':

                if (!empty(Request::input('id')) && Request::input('id') != 1) {

                    Log::write('Удалил пользователя ' . User::where('id', Request::input('id'))->first()->name);
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
                    Log::write('Изменил данные пользователя ' . Request::input('name'));

                    return Redirect::back()->with('msg', 'Пользовательские данные успешно отредактированы');
                } else {


                    return Redirect::back()->with('msg', 'Поля Имя, Login и email не должны быть пустыми');
                }

                break;

            case 'add':


                if (!empty(Request::input('name')) && !empty(Request::input('login')) && !empty(Request::input('email')) && !empty(Request::input('password'))) {


                    User::firstOrCreate(array('name' => Request::input('name'), 'login' => Request::input('login'), 'email' => Request::input('email'), 'password' => md5(Request::input('password'))));
                    Log::write('Добавил пользователя ' . Request::input('name'));
                    return Redirect::back()->with('msg', 'Пользователь успешно добавлен');
                } else {

                    return Redirect::back()->with('msg', 'Все поля обязательны для заполнения');
                }

                break;
        }
    }

    public function showAnswerPage()
    {

        $questions = Faq::where('status_id', 1)->get();

        return view('admin.answer')->withContent(self::getBaseInfo())
                ->withQuestions($questions)
                ->withCategories(Category::all())
                ->withStatuses(Status::all())
                ->withDescription('Список вопросов нуждающихся в ответе');
    }

    public function showHidedPage()
    {

        $questions = Faq::where('status_id', 2)->get();

        return view('admin.answer')->withContent(self::getBaseInfo())
                ->withQuestions($questions)
                ->withCategories(Category::all())
                ->withStatuses(Status::all())
                ->withDescription('Список скрытых вопросов');
    }

    public function showManagePage()
    {

        return view('admin.answer')->withContent(self::getBaseInfo())
                ->withQuestions(Faq::all())
                ->withCategories(Category::all())
                ->withStatuses(Status::all())
                ->withDescription('Список всех вопросов');
    }

    public function manageAnswer()
    {

        switch (Request::input('action')) {

            case 'edit':

                if (!empty(Request::input('category')) && !empty(Request::input('status')) &&
                    !empty(Request::input('questioner_name')) && !empty(Request::input('questioner_email')) &&
                    !empty(Request::input('question')) && !empty(Request::input('answer')) &&
                    !empty(Request::input('id'))) {

                    Faq::where('id', Request::input('id'))->update(array('category_id' => Request::input('category'),
                        'status_id' => Request::input('status'),
                        'questioner_name' => Request::input('questioner_name'),
                        'questioner_email' => Request::input('questioner_email'),
                        'question' => Request::input('question'),
                        'answer' => Request::input('answer')
                    ));
                    Log::write('Обновил вопрос номер ' . Request::input('id'));
                    return Redirect::back()->with('msg', 'Вопрос успешно обновлен');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка обновления данных');
                }
                break;

            case 'delete':

                if (!empty(Request::input('id'))) {

                    Faq::where('id', Request::input('id'))->delete();
                    Log::write('Удалил вопрос номер ' . Request::input('id'));
                    return Redirect::back()->with('msg', 'Ворпос успешно удален');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка удаления вопроса');
                }

                break;
        }
    }

    public function showCategoriesPage()
    {

        return view('admin.categories')->withContent(self::getBaseInfo())
                ->withCategories(Category::all())
                ->withDescription('Управление категориями');
    }

    public static function showAnswerByCategory()
    {

        $category_id = Category::all()->first()->id;


        return view('admin.list')->withContent(self::getBaseInfo())
                ->withQuestions(Faq::all())
                ->withCategories(Category::all())
                ->withStatuses(Status::all())
                ->withSelectedId($category_id)
                ->withDescription('Список вопросов в категории');
    }

    public static function showAnswerByPostedCategory()
    {

        if (!empty(Request::input('category_id'))) {

            $category_id = Request::input('category_id');

            return view('admin.list')->withContent(self::getBaseInfo())
                    ->withQuestions(Faq::all())
                    ->withCategories(Category::all())
                    ->withStatuses(Status::all())
                    ->withSelectedId($category_id)
                    ->withDescription('Список вопросов в категории');
        } else {
            return false;
        }
    }
}
