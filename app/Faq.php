<?php

namespace App\Http\Controllers;

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
    {

    public static function GetStatusList()
        {

        return DB::table('status')->get();
        }

    public static function GetAllApproved()
        {

        $result = DB::select('SELECT qa.id, qa.question, qa.answer, qa.category_id, categories.category_name FROM `qa` INNER JOIN categories on qa.category_id = categories.id WHERE status_id=3 ORDER by categories.id');

        return $result;
        }

    public static function GetCategoryList()
        {

        return DB::select('SELECT * FROM categories ORDER BY id');
        }

    public static function Count()
        {

        return DB::table('qa')->count();
        }

    public static function NotAnsweredCount()
        {

        return DB::table('qa')->whereNULL('answer')->count();
        }

    public static function LastQuestions($count = 10)
        {

        return DB::select("SELECT qa.*, categories.category_name FROM `qa` INNER JOIN categories on qa.category_id = categories.id ORDER by id DESC LIMIT $count");
        }

    public static function AddQuestion($questionerName, $questionerEmail, $question, $category)
        {

        return DB::table('qa')->insertGetId(array('category_id' => $category, 'questioner_name' => $questionerName, 'questioner_email' => $questionerEmail, 'question' => $question));
        }

    public static function GetAll($status = '')
        {

        if ($status) {
            return DB::table('qa')
                            ->join('categories', 'qa.category_id', '=', 'categories.id')
                            ->join('status', 'qa.status_id', '=', 'status.id')
                            ->select('qa.*', 'categories.category_name', 'status.status_name')
                            ->where('qa.status_id', $status)
                            ->get();
        } else {

            return DB::table('qa')
                            ->join('categories', 'qa.category_id', '=', 'categories.id')
                            ->join('status', 'qa.status_id', '=', 'status.id')
                            ->select('qa.*', 'categories.category_name', 'status.status_name')
                            ->get();
        }
        }

    public static function UpdateQuestion($id, $category, $status, $questioner_name, $questioner_email, $question, $answer)
        {

        return DB::table('qa')->where('id', $id)
                        ->update(array('category_id' => $category, 'status_id' => $status, 'questioner_name' => $questioner_name,
                            'questioner_email' => $questioner_email, 'question' => $question, 'answer' => $answer));
        }

    }
