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
        ], [
            'nik.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        // Ambil data user berdasarkan NIK yang diberikan
        $user = UserModel::whereHas('user', function ($query) use ($request) {
            $query->where('nik', $request->nik);
        })->first();

        // Jika user tidak ditemukan atau password salah, kembalikan ke halaman login
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->route('login')->with('error', 'Username atau Password Salah');
        }

        // Authentikasi pengguna dengan menggunakan user yang ditemukan
        Auth::login($user);
        return redirect()->route('xpro.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil logout');
    }
}
