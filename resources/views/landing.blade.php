<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Peminjaman Barang Labor IoT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <div class="navbar-nav">
        <a class="nav-link" href="#barang-tersedia">Barang</a>
        <a class="nav-link" href="#fitur">Fitur</a>
        <a class="nav-link" href="/login">Login</a>
        <a class="nav-link" href="/register">Registrasi</a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="container">
    <h1>Sistem Peminjaman Barang<br>di Laboratorium IoT</h1>
    <a href="#masuk" class="btn btn-dark mt-4 px-4 py-2">Mulai Meminjam</a>
  </div>
</section>

<!-- Fitur Section -->
<section class="features bg-white" id="fitur">
  <div class="container text-center">
    <h2 class="mb-5">Fitur Unggulan</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-icon mb-3"><i class="bi bi-camera-video-fill"></i></div>
        <h5>Scan Wajah Otomatis</h5>
        <p>Verifikasi wajah menggunakan ESP32-CAM untuk keamanan saat meminjam barang.</p>
      </div>
      <div class="col-md-4">
        <div class="feature-icon mb-3"><i class="bi bi-hdd-network-fill"></i></div>
        <h5>Pemantauan Real-Time</h5>
        <p>Lihat status barang langsung dari dashboard, kapan dan siapa yang meminjam.</p>
      </div>
      <div class="col-md-4">
        <div class="feature-icon mb-3"><i class="bi bi-gear-fill"></i></div>
        <h5>Otomasi Pintu Lemari</h5>
        <p>Lemari akan terbuka otomatis saat peminjam terverifikasi berhasil.</p>
      </div>
    </div>
  </div>
</section>

<!-- Barang Tersedia Section -->
<section class="py-5 bg-light" id="barang-tersedia">
  <div class="container text-center">
    <h2 class="py-10 fw-bold">Barang yang Tersedia</h2>

    @if($barangs->isEmpty())
      <p class="text-muted">Belum ada barang tersedia saat ini.</p>
    @else
      <div class="row g-4 justify-content-center">
        @foreach($barangs as $barang)
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



<!-- CTA Section -->
<section class="text-center py-5 bg-light" id="masuk">
  <div class="container">
    <h3 class="mb-3">Sudah Siap Menggunakan Sistem Peminjaman?</h3>
    <a href="{{ route('login') }}" class="btn btn-outline-primary px-4 py-2 me-2">Login</a>
    <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2">Daftar</a>
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
