<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    // Menampilkan daftar peminjaman user yang sedang login
    public function index()
    {
        $peminjamans = Peminjaman::with('barang')
            ->where('user_id', auth()->id())
            ->orderBy('tgl_peminjaman', 'desc')
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    // Menampilkan form peminjaman barang
    public function create($id)
    {
        $barang = Barang::findOrFail($id);
        return view('peminjaman.form', compact('barang'));
    }

    // Proses peminjaman barang
    public function store(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($id);

        if ($barang->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        // Membuat data peminjaman
        Peminjaman::create([
            'user_id' => auth()->id(),
            'barang_id' => $barang->id,
            'status' => 'Dipinjam',
            'tgl_peminjaman' => now(),
            'jumlah' => $request->jumlah,
        ]);

        // Kurangi stok barang
        $barang->decrement('stok', $request->jumlah);

        return redirect()->route('barang.index')->with('success', 'Peminjaman berhasil.');
    }

    // Proses pengembalian barang (dari user atau admin)
    public function return($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    $barang = $peminjaman->barang;

    if ($peminjaman->status === 'Dikembalikan') {
        return redirect()->back()->with('info', 'Barang sudah dikembalikan.');
    }

    // Tambah stok barang
    $barang->increment('stok', $peminjaman->jumlah);

    // Update status dan tanggal pengembalian
    $peminjaman->update([
        'status' => 'Dikembalikan',
        'tgl_pengembalian' => now(),
    ]);

    return redirect()->back()->with('success', 'Barang berhasil dikembalikan.');
}
}
