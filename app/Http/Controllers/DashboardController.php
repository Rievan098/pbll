<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data barang dan peminjaman dengan relasi user dan barang
        $barangs = Barang::all(); // Ambil semua barang
        $peminjamans = Peminjaman::with(['user', 'barang'])->latest()->get(); // Ambil peminjaman beserta user dan barangnya

        // Kirim data ke view
        return view('admin.dashboard', compact('barangs', 'peminjamans'));

        
    }

    
}

