<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Faq;
use App\User;
use App\Categories;

class Admin extends Model
    {

    public static function GetBaseInfo()
        {

        session_start();

        if ($_SESSION) {

            $content['admin_name'] = $_SESSION['name'];
            $content['admin_count'] = User::select()->count();
            $content['qa_count'] = Faq::Count();
            $content['categories_count'] = Categories::select()->count();
            $content['not_answered_count'] = Faq::NotAnsweredCount();

            return $content;
        }
        }

    }
