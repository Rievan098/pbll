<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login'); // Pastikan file ini ada di views/auth/login.blade.php
    }

    public function login(Request $request)
{
    $validated = $request->validate([
        'nim' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['nim' => $validated['nim'], 'password' => $validated['password']])) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/user/dashboard');
        }
    } else {
        return back()->withErrors(['nim' => 'NIM atau password salah.']);
    }
}


    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
