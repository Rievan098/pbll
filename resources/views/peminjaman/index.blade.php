@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Riwayat Peminjaman</h2>

    {{-- Alert sukses atau error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-hover table-striped">
        <thead>
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
                    <td>{{ $p->user ? $p->user->name : 'User tidak ditemukan' }}</td>
                    <td>{{ $p->barang ? $p->barang->nama_barang : 'Barang tidak ditemukan' }}</td>
                    <td>
                        @if(strtolower($p->status) === 'dipinjam')
                            <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning"
                                    onclick="return confirm('Konfirmasi barang telah dikembalikan?')">
                                    Tandai Dikembalikan
                                </button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-success" disabled>
                                Dikembalikan
                            </button>
                        @endif
                    </td>
                    <td>{{ $p->jumlah }}</td>
                    <td>{{ $p->tgl_peminjaman->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada riwayat peminjaman.</td></tr>
            @endforelse
        </tbody>
    </table>

</div>

{{-- Bootstrap JS for alerts --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@endsection
