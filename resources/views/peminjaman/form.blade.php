@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3>Form Peminjaman Barang</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pinjam.barang.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="barang_id">Pilih Barang:</label>
            <select name="barang_id" id="barang_id" class="form-control" required>
                <option value="">-- Pilih Barang --</option>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}">
                        {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="jumlah">Jumlah Pinjam (max 2):</label>
            <input type="number" name="jumlah" id="jumlah" min="1" max="2" class="form-control" required>
        </div>


 
        <button type="submit" class="btn btn-primary mt-3">Pinjam</button>
    </form>
</div>
@endsection