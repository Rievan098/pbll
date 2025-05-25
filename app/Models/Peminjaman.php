<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'barang_id',
        'status',
        'tgl_peminjaman',
        'tgl_pengembalian', // ✅ tambahkan ini
        'jumlah',
    ];

    protected $casts = [
        'tgl_peminjaman' => 'datetime',
        'tgl_pengembalian' => 'datetime', // ✅ tambahkan ini juga
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Opsional: Ambil peminjam lain
    public function peminjamLain()
    {
        return self::where('barang_id', $this->barang_id)
            ->where('user_id', '!=', $this->user_id)
            ->with('user')
            ->get();
    }
}
