<?php
namespace App\Http\Controllers;

use Request;
use App\Category;
use App\Faq;

class FaqController extends Controller
{

    public function showIndex()
    {


        $approvedFaqs = Faq::where('status_id', 3)
            ->join('categories', 'faqs.category_id', '=', 'categories.id')
            ->select('faqs.*', 'categories.category_name')
            ->get();

        return view('index')->withOutput($approvedFaqs)->withCatlist(Category::all());
    }

    public function ask()
    {

        $categories = Category::all();

        if (!empty(Request::input('name')) && !empty(Request::input('email')) && !empty(Request::input('question')) && !empty(Request::input('category'))) {


            if ($result = Faq::AddQuestion(Request::input('name'), Request::input('email'), Request::input('question'), Request::input('category'))) {

                return view('askok')->withMsg($result);
            } else {


                return view('ask')->withCategories($categories)->withMsg('Ошибка добавление вопроса в базу');
            }
        } else {

            return view('ask')->withCategories($categories)->withMsg('Все поля обязательны для заполнения');
        }
    }

    public function showAskForm()
    {
        return view('ask')->withCategories(Category::all());
    }
}
