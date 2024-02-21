<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($infologin)) {
            return redirect('buku')->with('success', 'Berhasil login');
        } else {
            return redirect('/')->withErrors('Username dan password yang dimasukkan tidak sesuai');
        }
    }
    function logout()
{
    Auth::logout();
    return redirect('/')->with('success', 'Berhasil logout');
}


function register()
{
    return view('auth.register');
}
function create(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8'
    ], [
        'nama.required' => 'Nama wajib diisi',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Email yang dimasukkan tidak valid',
        'email.unique' => 'Email sudah digunakan, silakan masukkan email yang lain',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Minumum password 8 karakter'
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ];
    User::create($data);

    $infologin = [
        'email' => $request->email,
        'password' => $request->password
    ];

    if (Auth::attempt($infologin)) {
        return redirect('register')->with('success', 'Berhasil login');
    } else {
        return redirect('/')->withErrors('Username dan password yang dimasukkan tidak sesuai');
    }
}
}





