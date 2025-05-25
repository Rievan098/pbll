@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Barang</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
        </div>

        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control" value="{{ $barang->stok }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-2">Batal</a>
    </form>
</div>
@endsection
