<?php
namespace App\Http\Controllers;

use Request;
use App\Category;
use App\Faq;

class FaqController extends Controller
{

    public function showIndex()
    {
        $approvedFaqs = Faq::where('status_id', 3)->get();

        return view('index')->withOutput($approvedFaqs)->withCatlist(Category::all());
    }

    public function ask()
    {

        $categories = Category::all();

        if (!empty(Request::input('name')) && !empty(Request::input('email')) &&
            !empty(Request::input('question')) && !empty(Request::input('category'))) {
            if (Faq::create(array('questioner_name' => Request::input('name'),
                    'questioner_email' => Request::input('email'),
                    'question' => Request::input('question'),
                    'category_id' => Request::input('category')))) {
                return view('askok');
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
