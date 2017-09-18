<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;

class FaqController extends Controller
    {

    public function ShowIndex()
        {

        $faq = \App\Faq::GetAllApproved();
        $categories = \App\Categories::GetAll();

        return view('index')->withOutput($faq)->withCatlist($categories);
        }

    public function Ask()
        {

        $categories = \App\Categories::GetAll();

        if (!empty(Request::input('name')) && !empty(Request::input('email')) && !empty(Request::input('question')) && !empty(Request::input('category'))) {


            if ($result = \App\Faq::AddQuestion(Request::input('name'), Request::input('email'), Request::input('question'), Request::input('category'))) {

                return view('askok')->withMsg($result);
            } else {


                return view('ask')->withCategories($categories)->withMsg('Ошибка добавление вопроса в базу');
            }
        } else {

            return view('ask')->withCategories($categories)->withMsg('Все поля обязательны для заполнения');
        }
        }

    public function ShowAskForm()
        {

        $categories = \App\Categories::GetAll();

        return view('ask')->withCategories($categories);
        }

    }
