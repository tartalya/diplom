<?php
namespace App\Http\Controllers;

use Request;
use Redirect;
use App\Category;
use App\Faq;
use App\Log;

class CategoryController extends Controller
{

    public function addCategory()
    {
        if (Request::input('category_name')) {
            Category::firstOrCreate(array('category_name' => Request::input('category_name')));
            Log::write('Добавил категорию ' . Request::input('category_name'));
            return Redirect::back()->with('msg', 'Категория успешно добавлена');
        } else {
            return Redirect::back()->with('msg', 'Ошибка добавления категории');
        }
    }

    public function editCategory()
    {

        if (Request::input('category_id') && Request::input('category_name')) {
            Category::where('id', Request::input('category_id'))->update(array('category_name' => Request::input('category_name')));
            Log::write('Отредактировал категорию ' . Request::input('category_id') . ' новое название категории ' . Request::input('category_name'));
            return Redirect::back()->with('msg', 'Категория успешно изменена');
        } else {
            return Redirect::back()->with('msg', 'Ошибка переименования категории');
        }
    }

    public function deleteCategory()
    {
        if (Request::input('category_id')) {
            Log::write('Удалил категорию ' . Request::input('category_id'));
            Faq::where('category_id', Request::input('category_id'))->delete();
            Category::destroy(Request::input('category_id'));
            return Redirect::back()->with('msg', 'Категория успешно удалена');
        } else {
            return Redirect::back()->with('msg', 'Ошибка удаления категории');
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
