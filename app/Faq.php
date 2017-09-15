<?php

namespace App\Http\Controllers;

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
    {

    public static function GetAllApproved()
        {

        $result = DB::select('SELECT qa.id, qa.question, qa.answer, qa.category_id, categories.category_name FROM `qa` INNER JOIN categories on qa.category_id = categories.id WHERE status_id=3 ORDER by categories.id');

        return $result;
        }

    public static function GetCategoryList()
        {

        $result = DB::select('SELECT * FROM categories ORDER BY id');

        return $result;
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
            
            return DB::table('qa')->insert(array('category_id' => $category, 'questioner_name' => $questionerName, 'questioner_email' => $questionerEmail, 'question' => $question));
 
            }
    }
