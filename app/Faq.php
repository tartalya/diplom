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

        if (!empty($status)) {
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

    public static function RemoveQuestion($id)
        {

        return DB::table('qa')->where('id', $id)->delete();
        }

    public static function RemoveQuestionsByCategory($category_id)
        {

        return DB::table('qa')->where('category_id', $category_id)->delete();
        }

    public static function Count($category = '', $status = '')
        {

        if (!empty($category) && !empty($status)) {

            $query = DB::table('qa')->where('category_id', $category)->where('status_id', $status)->count();
        } else if (!empty($category)) {

            $query = DB::table('qa')->where('category_id', $category)->count();
        } else if (!empty($status)) {

            $query = DB::table('qa')->where('status_id', $status)->count();
        } else {

            $query = DB::table('qa')->count();
        }

        return $query;
        }

    }
