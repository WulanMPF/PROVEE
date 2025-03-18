<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $breadcrumb = (object) [
            'title' => 'Profile',
        ];

        $activeMenu = 'profile';

        return view('profile', ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu], compact('user'));
    }

    // RESET PASSWORD GAISO
    public function reset_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();
        dd(get_class($user));

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
