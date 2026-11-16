<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            LogAktivitas::create([
                'user_id' => Auth::id(),
                'nama_user' => Auth::user()->nama,
                'role' => Auth::user()->role,
                'modul' => 'Autentikasi',
                'aktivitas' => 'Login ke sistem',
                'ip_address' => $request->ip(),
            ]);

            return redirect('/dashboard');
        }

        return redirect('/login')->with('error', 'Login Gagal !, Username atau Password salah');
    }

    public function actionLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
