<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Barang;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('barang')
            ->where('user_id', auth()->id())
            ->orderBy('tgl_peminjaman', 'desc')
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
{
    $barangs = Barang::all();
    return view('peminjaman.form', compact('barangs'));
}

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1|max:2',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        // Simpan ke database
        Peminjaman::create([
            'user_id' => auth()->id(),
            'barang_id' => $barang->id,
            'status' => 'Dipinjam',
            'tgl_peminjaman' => now(),
            'jumlah' => $request->jumlah,
        ]);

        // (Opsional) Kirim data ke NodeMCU jika digunakan
        try {
            Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post('http://172.20.10.2/borrow', [
                'barang_id' => $barang->id,
                'jumlah' => $request->jumlah
            ]);
        } catch (\Exception $e) {
            // Log error
            \Log::error('NodeMCU tidak dapat dijangkau: ' . $e->getMessage());
            
            // Berikan notifikasi ke user (opsional)
            session()->flash('warning', 'Peminjaman berhasil disimpan, tetapi perangkat IoT sedang offline.');
        }

        // Update stok
        $barang->decrement('stok', $request->jumlah);

        return redirect()->route('barang.index')->with('success', 'Peminjaman berhasil.');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $barang = $peminjaman->barang;

        if ($peminjaman->status === 'Dikembalikan') {
            return redirect()->back()->with('info', 'Barang sudah dikembalikan.');
        }

        $barang->increment('stok', $peminjaman->jumlah);

        $peminjaman->update([
            'status' => 'Dikembalikan',
            'tgl_pengembalian' => now(),
        ]);

        return redirect()->back()->with('success', 'Barang berhasil dikembalikan.');
    }
}