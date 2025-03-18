<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function proses_login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nik' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'nik' => $request->nik,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            return redirect()->route('xpro.index');
        } else {
            return redirect()->route('login')->with('failed', 'Username atau Password Salah');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');

        // SUCCESS MESSAGE
        // return redirect()->route('login')->with('success', 'Anda Berhasil Log Out');
    }
}
