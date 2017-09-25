<?php
namespace App\Http\Controllers;

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    protected $fillable = ['questioner_name', 'questioner_email', 'question', 'category_id'];
    
    public static function updateQuestion($id, $category, $status, $questioner_name, $questioner_email, $question, $answer)
    {

        return DB::table('faqs')->where('id', $id)
                ->update(array('category_id' => $category, 'status_id' => $status, 'questioner_name' => $questioner_name,
                    'questioner_email' => $questioner_email, 'question' => $question, 'answer' => $answer));
    }

    public function status()
    {

        return $this->belongsTo('App\Status');
    }

    public function category()
    {

        return $this->belongsTo('App\Category');
    }
}
