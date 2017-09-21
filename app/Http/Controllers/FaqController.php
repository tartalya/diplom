<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Categories;
use App\Faq;


class FaqController extends Controller
    {

    public function showIndex()
        {

        $faq = Faq::GetAllApproved();
        $categories = Categories::all();

        return view('index')->withOutput($faq)->withCatlist($categories);
        }

    public function ask()
        {

        $categories = Categories::all();

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

        $categories = Categories::all();

        return view('ask')->withCategories($categories);
        }

    }
