<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    
        public function inFaq()
        {
        
        return $this->hasMany('App\Faq');
        }
        
}
