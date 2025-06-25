<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .hero {
            background: url('{{ asset('images/ml.jpg') }}') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 150px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: black; /* Ubah dari warna default (white via parent) ke hitam */
            text-shadow: none; /* Optional: hapus efek bayangan jika ingin benar-benar hitam bersih */
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 20px;
            text-shadow: 1px 1px 3px rgba(254, 254, 254, 0.5);
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.6); 
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }
        .form-label {
            font-weight: bold;
        }
        .alert {
            border-radius: 5px;
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

    <div class="hero">
        <div class="login-container">
            <h1 class="text-center mb-4">Login</h1>

            <!-- Menampilkan pesan sukses setelah registrasi -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Menampilkan pesan error jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" name="nim" id="nim" class="form-control" value="{{ old('nim') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <p class="mt-3 text-center">Belum punya akun? <a href="{{ url('/register') }}" class="text-white">Daftar</a></p>
        </div>
    </div>

</body>
</html>
