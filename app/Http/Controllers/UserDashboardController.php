<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\Barang;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua peminjaman user beserta barangnya (eager load)
        $peminjamanUser = Peminjaman::with('barang')
            ->where('user_id', $user->id)
            ->get();

        // Ambil ID barang yang sedang dipinjam user
        $barangIds = $peminjamanUser->pluck('barang_id');

        // Ambil peminjam lain (selain user) yang meminjam barang yang sama
        $peminjamLain = Peminjaman::with(['user', 'barang'])
            ->whereIn('barang_id', $barangIds)
            ->where('user_id', '!=', $user->id)
            ->get();

        return view('user.dashboard', compact('user', 'peminjamanUser', 'peminjamLain'));
    }
}
