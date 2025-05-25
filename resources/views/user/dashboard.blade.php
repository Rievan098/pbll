@extends('layouts.user')

@push('styles')
<style>
    body {
        background: linear-gradient(to bottom right, #f0f2f5, #d9e2ec);
    }
</style>
@endpush


@section('content')
<style>
    body {
        background: url('/images/ml.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', sans-serif;
    }
    </style>
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3 bg-dark text-white min-vh-100 p-4">
            <h4 class="mb-4 text-center">Smartlend</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">🏠 Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('barang.index') }}" class="nav-link text-white">📦 Daftar Barang</a>
                </li>
                {{-- <li class="nav-item mb-2">
                    <a href="{{ route('peminjaman.index') }}" class="nav-link text-white">🕓 Riwayat Peminjaman</a>
                </li> --}}
                <li class="nav-item mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger w-100">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 p-4 bg-light">
            <h2 class="mb-4">Selamat Datang, {{ $user->name }}</h2>
            <p>Berikut informasi peminjaman barang Anda:</p>

            <!-- Barang yang Dipinjam (Tabel) -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Barang yang Anda Pinjam
                </div>
                <div class="card-body">
                    @if($peminjamanUser->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Peminjaman</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peminjamanUser as $index => $pinjam)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pinjam->barang->nama_barang }}</td>
                                            <td>{{ $pinjam->jumlah }}</td>
                                            <td>{{ $pinjam->tgl_peminjaman->format('d-m-Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">Anda belum meminjam barang.</p>
                    @endif
                </div>
            </div>

        

         
        </div>
    </div>
</div>
@endsection
