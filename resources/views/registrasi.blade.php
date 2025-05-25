<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Lengkap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .hero {
            background: url('{{ asset('images/ml.jpg') }}') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 120px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: black;
            text-shadow: none;
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 20px;
            text-shadow: 1px 1px 3px rgba(254, 254, 254, 0.5);
        }
        .card {
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }
        .form-label {
            font-weight: bold;
        }
        footer {
            background: #f8f9fa;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
        }
        .form-check-inline {
            margin-right: 10px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh; background: url('{{ asset('images/ml.jpg') }}') no-repeat center center fixed; background-size: cover;">

    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
        <h4 class="text-center mb-4">Form Registrasi</h4>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" required value="{{ old('nim') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="face_image" class="form-label">Foto Wajah</label>
                <input type="file" name="face_image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Laki-laki" required>
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan" required>
                    <label class="form-check-label">Perempuan</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>
    </div>

</body>
</html>
