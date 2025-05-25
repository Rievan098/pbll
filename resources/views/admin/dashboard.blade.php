@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <a class="btn btn-primary mb-3" href="{{ route('admin.barang.create') }}">Tambah Barang</a>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Daftar Barang --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Daftar Barang</h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $barang)
                        <tr>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.barang.edit', $barang->id) }}" class="btn btn-sm btn-warning me-1">
                                    Edit
                                </a>
                                <form action="{{ route('admin.barang.destroy', $barang->id) }}" method="POST" 
                                    class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Statistik peminjamn --}}
    <div class="card mt-4 shadow-sm">
    <div class="card-header" style="background: linear-gradient(90deg, #4e54c8, #8f94fb); color: white;">
        <h4 class="mb-0">Statistik Peminjaman Per Hari (7 Hari Terakhir)</h4>
    </div>
    <div class="card-body p-3">
        @if($chartData && $chartData->count())
        <table class="table table-bordered mb-4">
            <thead style="background-color: #8f94fb; color: white;">
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chartData as $tanggal => $total)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Canvas Chart --}}
        <canvas id="peminjamanChart" height="100"></canvas>

        @else
            <p>Tidak ada data peminjaman dalam 7 hari terakhir.</p>
        @endif
    </div>
</div>


    {{-- Riwayat Peminjaman --}}
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Riwayat Peminjaman</h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama User</th>
                        <th>Barang</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Waktu Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $p)
                        <tr>
                            <td>{{ $p->user?->name ?? 'User tidak ditemukan' }}</td>
                            <td>{{ $p->barang?->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                            <td>
                                @php
                                    $status = strtolower($p->status);
                                @endphp

                                @if ($status === 'dipinjam')
                                    <form action="{{ route('admin.peminjaman.return', $p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success"
                                            onclick="return confirm('Yakin barang sudah dikembalikan?')">
                                            Telah Dikembalikan
                                        </button>
                                    </form>
                                @elseif ($status === 'dikembalikan')
                                    <button class="btn btn-sm btn-dark" disabled>Dikembalikan</button>
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled>{{ ucfirst($p->status) }}</button>
                                @endif
                            </td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->tgl_peminjaman->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada riwayat peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data dari PHP ke JS (ubah tanggal ke format string yg konsisten)
    const labels = {!! json_encode($chartData->keys()->map(function($date) {
        return \Carbon\Carbon::parse($date)->format('d-m');
    })->toArray()) !!};

    const data = {!! json_encode($chartData->values()) !!};

    const ctx = document.getElementById('peminjamanChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: data,
                backgroundColor: 'rgba(13, 110, 253, 0.6)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
@endpush

@endsection
