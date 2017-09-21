<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    protected $fillable = ['category_name'];
}
