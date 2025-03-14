<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;

class ProfileController extends Controller
{
    public function index()
    {

        $user1 = Auth::user();

        // Ambil data warga berdasarkan warga_id dari user yang sedang login
        // $user = UserModel::where('id_user', $user1->id_user)->first();

        $breadcrumb = (object) [
            'title' => 'Profile',
        ];

        $activeMenu = 'profile';

        return view('profile', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
