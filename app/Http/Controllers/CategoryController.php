<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use Request;
use Redirect;
use App\Category;
use App\Faq;

class CategoryController extends Controller
{

    public function manageCategories()
    {

        switch (Request::input('action')) {

            case 'add':

                if (Request::input('category_name')) {
                    Category::firstOrCreate(array('category_name' => Request::input('category_name')));
                    return Redirect::back()->with('msg', 'Категория успешно добавлена');
                } else {
                    return Redirect::back()->with('msg', 'Ошибка добавления категории');
                }

                break;


            case 'delete':

                if (Request::input('category_id')) {
                    Faq::where('category_id', Request::input('category_id'))->delete();
                    Category::destroy(Request::input('category_id'));
                    return Redirect::back()->with('msg', 'Категория успешно удалена');
                } else {

                    return Redirect::back()->with('msg', 'Ошибка удаления категории');
                }

                break;

            case 'edit':

                if (Request::input('category_id') && Request::input('category_name')) {
                    Category::where('id', Request::input('category_id'))->update(array('category_name' => Request::input('category_name')));
                    return Redirect::back()->with('msg', 'Категория успешно изменена');
                } else {
                    return Redirect::back()->with('msg', 'Ошибка переименования категории');
                }
        }
    }

    public static function getNameById($id)
    {

        if (!empty($id)) {

            return Category::where('id', $id)->first()->category_name;
        } else {

            return '';
        }
    }
}
