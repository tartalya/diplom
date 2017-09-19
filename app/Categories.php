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

    public static function Add($category_name)
        {

        return DB::table('categories')->insert(array('category_name' => $category_name));
        }

    public static function Remove($id)
        {

        return DB::table('categories')->where('id', $id)->delete();
        }

    public static function Edit($id, $category_name)
        {

        return DB::table('categories')->where('id', $id)->update(array('category_name' => $category_name));
        }

    public static function GetFirstId()
        {

        $query = DB::table('categories')->first();

        return $query->id;
        }

    public static function GetNameByID($id)
        {

        $query = DB::table('categories')->select('category_name')->where('id', $id)->first();

        return $query->category_name;
        }

    }
