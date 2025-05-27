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

    public function reset_password(Request $request)
    {
        // Log::info('Reset password method called');
        // Validasi input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = UserModel::find(Auth::id());

        // Cek apakah user ditemukan dan password lama sesuai
        if (!$user || !Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        // Update password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}