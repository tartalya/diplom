<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class User extends Model
    {

    //

    public static function Auth($login, $password)
        {

        //$result = DB::select("SELECT * FROM users WHERE login='$login' AND password='$password'");
        return DB::table('users')->where('login', $login)->where('password', $password)->first();
        }

    public static function Count()
        {

        return DB::table('users')->count();
        }

    public static function GetAll()
        {

        return DB::table('users')->get();
        }

    public static function Edit($id, $newName, $newLogin, $newEmail, $newPassword)
        {

        if (empty($newPassword)) {

            return DB::table('users')->where('id', $id)
                            ->update(array('name' => $newName, 'login' => $newLogin, 'email' => $newEmail));
        } else {

            return DB::table('users')->where('id', $id)
                            ->update(array('name' => $newName, 'login' => $newLogin, 'email' => $newEmail, 'password' => md5($newPassword)));
        }
        }

    public static function Add($name, $login, $email, $password)
        {

        return DB::table('users')->insert(array('name' => $name, 'login' => $login, 'email' => $email, 'password' => md5($password)));
        }

    public static function Remove($id)
        {

        return DB::table('users')->where('id', $id)->delete();
        }

    }
