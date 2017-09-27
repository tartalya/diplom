<?php
namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = ['name', 'email', 'login', 'password'];

}
