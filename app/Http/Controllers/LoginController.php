<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.login.login', [
            'title' => 'Login'
        ]);
    }

    public function welcomeArticle()
    {
        $reports = Report::all();
        return view('pages.article.article', compact('reports'), [
            'title' => 'Article'
        ]);
    }

    public function indexLogin()
    {
        return view('pages.login.login', [
            'title' => 'Login'
        ]);
    }

    public function indexRegister()
    {
        return view('pages.login.register', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Masukkan email yang valid',
            'password.required' => 'Password harus diisi',

        ]);

        $user = User::where('email', $credentials['email'])->first();
        // $dataUser = User::all();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Masukkan email yang valid.'
            ]);
        }

        // Cek apakah password benar menggunakan Auth::attempt()
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.'
            ]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($user->role === 'staff') {
                return redirect()->route('staff.report')->with('success', 'Login berhasil!');
            } elseif ($user->role == 'head_staff') {
                return redirect()->route('head.staff.report')->with('success', 'Login Berhasil');
            }
            return redirect()->route('welcome_article')->with('success', 'Login berhasil!');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        Auth::login($user);

        return redirect()->route('welcome_article')->with('success', 'Registrasi berhasil dan anda telah login!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('proses.login')->with('success', 'Anda telah logout!');
    }
}
