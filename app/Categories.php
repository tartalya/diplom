<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
    {

    public static function Count()
        {
        return DB::table('categories')->count();
        }

    public static function GetAll()
        {

        return DB::table('categories')->get();
        }

    }
