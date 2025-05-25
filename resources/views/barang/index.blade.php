@extends('layouts.user')

@section('title', 'Daftar Barang IoT')

@section('content')
<style>
    body {
        background: url('/images/ml.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', sans-serif;
    }

    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        background-color: rgba(255, 255, 255, 0.95);
    }

    .status-tersedia {
        color: green;
        font-weight: bold;
    }

    .status-habis {
        color: red;
        font-weight: bold;
    }

    .table thead {
        background-color: #007bff;
        color: white;
    }

    .btn-outline-primary {
        background-color: white;
    }
</style>

<div class="container py-5">
    <div >
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            ← Kembali ke Dashboard
        </a>
    </div>

    <div class="text-center mb-4 text-dark">
        <h2 class="fw-bold">Daftar Barang IoT</h2>
        <p class="text-dark">Silakan pinjam barang yang tersedia di bawah ini</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="card card-custom p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>
                                @if ($barang->stok > 0)
                                    <span class="status-tersedia">Tersedia</span>
                                @else
                                    <span class="status-habis">Habis</span>
                                @endif
                            </td>
                            <td>
                                @if ($barang->stok > 0)
                                    <a href="{{ route('pinjam.form', $barang->id) }}" class="btn btn-success btn-sm">Pinjam</a>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Tidak Tersedia</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">Belum ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
