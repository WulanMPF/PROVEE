<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(string $id)
    {

        $user = UserModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Profile',
        ];

        $activeMenu = 'profile';

        return view('profile', ['breadcrumb' => $breadcrumb, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function reset(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        UserModel::find($id)->update([
            'password'  => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'confirm_new_password'  => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
        ]);
        return back()->with('success', 'Password berhasil diubah.');
    }
}
