<?php
namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

    protected $fillable = ['questioner_name', 'questioner_email', 'question', 'category_id', 'answer', 'status_id'];

    public function status()
    {

        return $this->belongsTo('App\Status');
    }

    public function category()
    {

        return $this->belongsTo('App\Category');
    }
}
