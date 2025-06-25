<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function dashboard()
    {
        $barangs = Barang::all();
    $peminjamans = Peminjaman::with(['barang', 'user'])->latest()->get();

    $chartData = Peminjaman::select(
            DB::raw('DATE(tgl_peminjaman) as tanggal'),
            DB::raw('count(*) as total')
        )
        ->where('tgl_peminjaman', '>=', Carbon::now()->subDays(6)->startOfDay())
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get()
        ->pluck('total', 'tanggal');

    return view('admin.dashboard', compact('barangs', 'peminjamans', 'chartData'));
        
    }

    public function createBarang()
    {
        return view('admin.create_barang');
    }

    public function storeBarang(Request $request)
{
    $request->validate([
        'nama_barang' => 'required',
        'stok' => 'required|integer|min:1'
    ]);

    Barang::create($request->only('nama_barang', 'stok'));

    return redirect()->route('admin.dashboard')->with('success', 'Barang berhasil ditambahkan');
}

public function create()
{
    return view('barang.create'); // ini harus sesuai dengan path file view
}




}
