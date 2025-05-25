@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $barang->id ? 'Edit' : 'Tambah' }} Barang</h3>
    <form action="{{ $barang->id ? route('admin.barang.update', $barang->id) : route('admin.barang.store') }}" method="POST">
        @csrf
        @if($barang->id)
            @method('PUT')
        @endif

        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>

        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" required>

        <button type="submit" class="btn btn-success mt-2">Simpan</button>
    </form>
</div>
@endsection
