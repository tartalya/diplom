<?php

namespace App\Http\Controllers;

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    public static function addQuestion($questionerName, $questionerEmail, $question, $category)
    {

        return DB::table('faqs')->insertGetId(array('category_id' => $category, 'questioner_name' => $questionerName, 'questioner_email' => $questionerEmail, 'question' => $question));
    }

    public static function getAllCombined($status = '')
    {

        if (!empty($status)) {
            return DB::table('faqs')
                            ->join('categories', 'faqs.category_id', '=', 'categories.id')
                            ->join('statuses', 'faqs.status_id', '=', 'statuses.id')
                            ->select('faqs.*', 'categories.category_name', 'statuses.status_name')
                            ->where('faqs.status_id', $status)
                            ->get();
        } else {
            return DB::table('faqs')
                            ->join('categories', 'faqs.category_id', '=', 'categories.id')
                            ->join('statuses', 'faqs.status_id', '=', 'statuses.id')
                            ->select('faqs.*', 'categories.category_name', 'statuses.status_name')
                            ->get();
        }
    }

    public static function updateQuestion($id, $category, $status, $questioner_name, $questioner_email, $question, $answer)
    {

        return DB::table('faqs')->where('id', $id)
                        ->update(array('category_id' => $category, 'status_id' => $status, 'questioner_name' => $questioner_name,
                            'questioner_email' => $questioner_email, 'question' => $question, 'answer' => $answer));
    }

    public static function count($category = '', $status = '')
    {

        if (!empty($category) && !empty($status)) {
            $query = DB::table('faqs')->where('category_id', $category)->where('status_id', $status)->count();
        } elseif (!empty($category)) {
            $query = DB::table('faqs')->where('category_id', $category)->count();
        } elseif (!empty($status)) {
            $query = DB::table('faqs')->where('status_id', $status)->count();
        } else {
            $query = DB::table('faqs')->count();
        }

        return $query;
    }

    public function status()
    {

        return $this->belongsTo('App\Status');
    }
}
