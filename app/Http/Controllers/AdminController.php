<?php
namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use Redirect;
use App\Faq;
use App\Category;
use App\User;
use App\Status;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public static function getBaseInfo()
    {
        $content['admin_name'] = Auth::user()->name;
        $content['admin_count'] = User::all()->count();
        $content['qa_count'] = Faq::all()->count();
        $content['categories_count'] = Category::all()->count();
        $content['not_answered_count'] = Faq::where('status_id', 1)->orWhere('answer', null)->count();

        return $content;
    }

    public function showAdminPanel()
    {
        $lastQuestion = Faq::orderBy('id', 'DESC')->take(15)->get();

        return view('admin.main')->withContent(self::getBaseInfo())->withlastQuestions($lastQuestion);
    }

    public function showAnswerPage()
    {

        $questions = Faq::where('status_id', 1)->orWhere('answer', null)->get();

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

    public function editAnswer(Request $request)
    {
        $this->validate($request, array('id' => 'required|integer'));
        $faq = Faq::find($request->id);
        $faq->category_id = $request->category_id;
        $faq->status_id = $request->status_id;
        $faq->questioner_name = $request->questioner_name;
        $faq->questioner_email = $request->questioner_email;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return Redirect::back()->with('msg', 'Вопрос успешно обновлен');
    }

    public function deleteAnswer(Request $request)
    {
        if (!empty($request->input('id'))) {
            Faq::destroy($request->id);
            return Redirect::back()->with('msg', 'Ворпос успешно удален');
        } else {
            return Redirect::back()->with('msg', 'Ошибка удаления вопроса');
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

    public static function showAnswerByPostedCategory(Request $request)
    {

        if (!empty($request->input('category_id'))) {
            $category_id = $request->input('category_id');
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
