<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
    {

    private static $baseContent;
    private static $lastQuestions;

    public function __construct()
        {

        self::$baseContent = \App\Admin::GetBaseInfo();
        self::$lastQuestions = \App\Faq::LastQuestions();
        }

    public function ShowAdminPanel()
        {

        //$content = \App\Admin::GetBaseInfo();
        if (self::$baseContent && self::$lastQuestions) {
            return view('admin.main')->withContent(self::$baseContent)->withlastQuestions(self::$lastQuestions);
        } else {

            return redirect()->route('login');
            ;
        }
        }

    public function ManageUsers()
        {

        if (self::$baseContent) {
            
            
            $users = \App\User::GetAll();
            
            return view('admin.edit')->withContent(self::$baseContent)->withUsers($users);
        }
        }

        public function EditUser() {
            
            
            var_dump($_POST);
            
            
            }
    }
