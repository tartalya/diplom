<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use Request;
use Redirect;

class CategoriesController extends Controller
    {

    public function ManageCategories()
        {

        switch (Request::input('action')) {

            case 'add':

                if (Request::input('category_name')) {
                    \App\Categories::Add(Request::input('category_name'));
                    return Redirect::back()->with('msg', 'Категория успешно добавлена');
                } else {
                    return Redirect::back()->with('msg', 'Ошибка добавления категории');
                }

                break;


            case 'delete':

                if (Request::input('category_id')) {
                    \App\Faq::RemoveQuestionsByCategory(Request::input('category_id'));
                    \App\Categories::Remove(Request::input('category_id'));
                    return Redirect::back()->with('msg', 'Категория успешно удалена');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка удаления категории');
                }

                break;

            case 'edit':

                if (Request::input('category_id') && Request::input('category_name')) {
                    \App\Categories::Edit(Request::input('category_id'), Request::input('category_name'));
                    return Redirect::back()->with('msg', 'Категория успешно изменена');
                } else {
                    return Redirect::back()->with('msg', 'Ошибка переименования категории');
                }
        }
        }

    public static function GetNameById($id)
        {

        if (!empty($id)) {

            return \App\Categories::GetNameByID($id);
        } else {

            return '';
        }
        }

    }
