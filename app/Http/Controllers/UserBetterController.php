<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Redirect;
use App\Log;

class UserBetterController extends Controller
{

    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['name'])) {

            Redirect::to('login')->send();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.edit')->withContent(AdminController::getBaseInfo())->withUsers(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!empty($request->name) && !empty($request->login) && !empty($request->email) && !empty($request->password)) {

            User::firstOrCreate(array('name' => $request->name,
                'login' => $request->login,
                'email' => $request->email,
                'password' => md5($request->password)));
            Log::write('Добавил пользователя ' . $request->name);
            return Redirect::back()->with('msg', 'Пользователь успешно добавлен');
        } else {

            return Redirect::back()->with('msg', 'Все поля обязательны для заполнения');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (User::find($id)) {

            return view('admin.edit')->withContent(AdminController::getBaseInfo())->withUsers(User::where('id', $id)->get());
        } else {

            return Redirect::back()->with('msg', 'Такого пользователя не существует');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (User::find($id)) {

            return view('admin.edit')->withContent(AdminController::getBaseInfo())->withUsers(User::where('id', $id)->get());
        } else {

            return Redirect::back()->with('msg', 'Такого пользователя не существует');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (!empty($request->id) && !empty($request->name) && !empty($request->login) && !empty($request->email)) {

            User::Edit($request->id, $request->name, $request->login, $request->email, $request->password);
            Log::write('Изменил данные пользователя ' . $request->name);

            return Redirect::back()->with('msg', 'Пользовательские данные успешно отредактированы');
        } else {


            return Redirect::back()->with('msg', 'Поля Имя, Login и email не должны быть пустыми');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!empty($id) && $id != 1) {

            Log::write('Удалил пользователя ' . User::where('id', $id)->first()->name);
            User::destroy($id);
            return Redirect::back()->with('msg', 'Пользователь удален');
        } else if ($id == 1) {

            return Redirect::back()->with('msg', 'Нельзя удалить супер администратора');
        } else {

            return Redirect::back()->with('msg', 'Ошибка удаления пользователя');
        }
    }
}
