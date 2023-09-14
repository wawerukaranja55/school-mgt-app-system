<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin_Controller extends Controller
{
    public function admin_dashboard()
    {
        return view('admins.admin_dashboard');
    }
}
