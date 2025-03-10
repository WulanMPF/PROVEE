<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = [
            'name' => 'Pandam Perdana Putra',
            'nik' => '00000000',
            'telegram_id' => '00000000',
        ];

        return view('profile', compact('user'));
    }
}