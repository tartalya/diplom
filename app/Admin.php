<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
    {

    public static function GetBaseInfo()
        {

        session_start();

        if ($_SESSION) {

            $content['admin_name'] = $_SESSION['name'];
            $content['admin_count'] = \App\User::Count();
            $content['qa_count'] = \App\Faq::Count();
            $content['categories_count'] = \App\Categories::Count();
            $content['not_answered_count'] = \App\Faq::NotAnsweredCount();

            return $content;
        }
        }

    }
