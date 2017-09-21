<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = ['name', 'email', 'login', 'password'];

    public static function edit($id, $newName, $newLogin, $newEmail, $newPassword)
    {

        if (empty($newPassword)) {
            return DB::table('users')->where('id', $id)
                            ->update(array('name' => $newName, 'login' => $newLogin, 'email' => $newEmail));
        } else {
            return DB::table('users')->where('id', $id)
                            ->update(array('name' => $newName, 'login' => $newLogin, 'email' => $newEmail, 'password' => md5($newPassword)));
        }
    }
}
