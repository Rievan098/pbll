<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SMARTLEND</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }
    .hero {
      background: url('{{ asset('images/back.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      color: white;
      padding: 120px 0;
      text-align: center;
    }
    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
      color: black;
    }
    .features {
      padding: 60px 20px;
    }
    .feature-icon {
      font-size: 40px;
      color: #0d6efd;
    }
    .card:hover {
      transform: translateY(-5px);
      transition: all 0.3s ease;
    }
    footer {
      background: #f8f9fa;
      padding: 20px 0;
      text-align: center;
      font-size: 14px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">SMARTLEND TEAM</a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <div class="navbar-nav">
        <a class="nav-link" href="#barang-tersedia">Barang</a>
        <a class="nav-link" href="#fitur">Fitur</a>
        <a class="nav-link" href="#pengguna-terdaftar">Peminjam</a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <h1>Sistem Peminjaman Barang<br />di Laboratorium IoT</h1>
    <h1><a href="{{ route('login') }}" class="btn btn-outline-dark px-4 py-2 me-2">Login</a>
    <a href="{{ route('register') }}" class="btn btn-dark px-4 py-2">Daftar</a>
  </h1>
     </div>
</section>


<!-- Barang Tersedia Section -->
<section class="py-5 bg-light" id="barang-tersedia">
  <div class="container text-center">
    <h2 class="py-10 fw-bold">Barang yang Tersedia</h2>

    @if ($barangs->isEmpty())
      <p class="text-muted">Belum ada barang tersedia saat ini.</p>
    @else
      <div class="row g-4 justify-content-center">
        @foreach ($barangs as $barang)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0">
              <div class="card-body">
                <div class="mb-3 text-primary">
                  <i class="bi bi-box-seam" style="font-size: 2rem;"></i>
                </div>
                <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                <p class="card-text">
                  <span class="badge bg-success">Stok: {{ $barang->stok }}</span>
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>

<!-- Pengguna Terdaftar Section -->
<section class="py-5 bg-white" id="pengguna-terdaftar">
  <div class="container">
    <h2 class="text-center mb-4">Pengguna Terdaftar</h2>

    @if ($users->isEmpty())
      <p class="text-muted text-center">Belum ada pengguna yang mendaftar.</p>
    @else
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>NIM</th>
              <th>Jenis Kelamin</th>
              {{-- Uncomment jika mau tampilkan foto
              <th>Foto Wajah</th>
              --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $index => $user)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->nim }}</td>
                <td>{{ $user->jenis_kelamin }}</td>
                {{-- 
                <td>
                  @if ($user->face_image)
                    <img src="{{ asset('images/' . $user->face_image) }}" alt="Foto Wajah" width="60" class="rounded-circle" />
                  @else
                    <span class="text-muted">Tidak ada</span>
                  @endif
                </td>
                --}}
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</section>


<!-- Footer -->
<footer>
  <p>&copy; 2025 Laboratorium IoT | Politeknik Negeri Padang</p>
  <p>Developed by <strong>SmartLend Team</strong></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
