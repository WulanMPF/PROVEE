<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $breadcrumb = (object) ['title' => 'Profile'];
        $activeMenu = 'profile';

        return view('profile', compact('breadcrumb', 'activeMenu', 'user'));
    }

    public function reset(Request $request, string $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = UserModel::find($id);

        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}
