<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\UserModel;
use App\Models\WargaModel;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'password' => 'required',
        ]);

        // Coba ambil user berdasarkan NIK
        $user = UserModel::where('nik', $request->nik)->first();

        if (!$user) {
            return back()->withErrors(['login_gagal' => 'User tidak ditemukan']);
        }

        // Authentikasi user
        Auth::login($user);
        dd(Auth::check()); // Debugging untuk memastikan user terautentikasi
        return redirect()->route('xpro.index');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil logout');
    }
}
