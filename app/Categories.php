<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
    {

    protected $fillable = ['category_name'];

    public function inFaq()
        {

        return $this->hasMany('App\Faq');
        }

    }
