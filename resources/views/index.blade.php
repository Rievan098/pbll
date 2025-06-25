<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-tersedia {
            color: green;
            font-weight: bold;
        }
        .status-habis {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-4">Daftar Barang IoT</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover shadow">
            <thead class="table-primary text-center">
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
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
                            <a href="{{ route('pinjam.form', $barang->id) }}" class="btn btn-sm btn-success">Pinjam</a>

                            @else
                                <button class="btn btn-sm btn-secondary" disabled>Tidak Tersedia</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data barang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        
    </div>
</body>
</html>
