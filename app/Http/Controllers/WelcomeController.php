<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        $activeMenu = 'dashboard';

        return view('welcome', ['activeMenu' => $activeMenu]);
    }
}
