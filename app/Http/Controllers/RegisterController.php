<?php

namespace App\Http\Controllers; // Pastikan namespace ini benar

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('registrasi'); // Pastikan file bernama "registrasi.blade.php" dan disimpan di folder views/layouts
    }

    // Menyimpan data registrasi
    public function register(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|unique:users,nim',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'face_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:6',
        ]);

        // Jika ada gambar diupload
        if ($request->hasFile('face_image')) {
            $imageName = time() . '.' . $request->face_image->extension();
            $request->face_image->move(public_path('images'), $imageName);
            $validated['face_image'] = $imageName;
        }

        // Enkripsi password
        $validated['password'] = Hash::make($validated['password']);

        // Simpan user ke database
        User::create($validated);

        // Arahkan ke halaman login
        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
