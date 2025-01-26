<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
         // Validate input fields
         $request->validate([
            'user_nama' => 'required',
            'user_pass' => 'required',
        ]);

    
        // Get the credentials from the request
        $credentials = [
            'user_nama' => $request->user_nama,
            'user_pass' => $request->user_pass, // password should match the field name used in the database
        ];

        $user = User::where('user_nama', $credentials['user_nama'])->first();

        if ($user && Hash::check($credentials['user_pass'], $user->user_pass)) {
            // dd('test');
            Auth::login($user);

            return redirect('barang-inventaris')->with('success', 'Login berhasil!');
        }


        return back()->withErrors(['user_id' => 'ID pengguna atau password salah.']);
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        
        // dd($request->all());
        // Validasi data input dari user
        $request->validate([
            'user_nama' => 'required|string|max:255',
            // 'user_id' => 'required|string|unique:tm_users',
            'user_pass' => 'required|string|min:8',
            // 'user_hak' => 'required|string',
            // 'user_sts' => 'required|string',
        ]);

        // Menyimpan data ke database
        $user = User::create([
            'user_id' => rand(111, 999),
            'user_nama' => $request->user_nama,
            'user_pass' => Hash::make($request->user_pass), // Hash password
            'user_hak' => null,
            'user_sts' => null,
        ]);

        // Menyimpan user yang baru didaftarkan ke session
        // Auth::login($user);

        // Redirect ke halaman barang.index setelah registrasi berhasil
        return redirect('login')->with('success', 'Account created successfully. Welcome!');
    }

    public function logout(Request $request)
    {
         Auth::logout(); 
         $request->session()->invalidate(); 
         $request->session()->regenerateToken(); 

         return redirect('login');
    }

}