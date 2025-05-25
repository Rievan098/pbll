@extends('layouts.app') <!-- Atau sesuaikan dengan layout kamu -->

@section('content')
<div class="container py-5">
    <h3>Form Peminjaman Barang</h3>
    <form action="{{ route('pinjam.barang', $barang->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" class="form-control" value="{{ $barang->nama_barang }}" readonly>
        </div>
        <div class="mb-3">
            <label>Stok Tersedia</label>
            <input type="text" class="form-control" value="{{ $barang->stok }}" readonly>
        </div>
        <div class="mb-3">
            <label>Jumlah yang Dipinjam</label>
            <input type="number" name="jumlah" class="form-control" min="1" max="{{ $barang->stok }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Pinjam</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
