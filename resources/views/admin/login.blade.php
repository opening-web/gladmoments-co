<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Glad Moments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDFCF7;
            background-image: radial-gradient(#EAE5DB 1px, transparent 1px);
            background-size: 20px 20px;
            height: 100vh;
        }
        h2 {
            font-family: 'Playfair Display', serif;
            color: #E6E1DA;
        }
        h2 span {
            color: #B39467;
        }
        .login-card {
            background-color: #1A1412;
            border: 1px solid #2D2421;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            padding: 40px 32px;
            box-shadow: 0 20px 40px rgba(26, 20, 18, 0.15);
        }
        .form-label {
            color: #B5AFA7;
            font-size: 13px;
            font-weight: 500;
        }
        .form-control {
            background-color: #2D2421;
            border: 1px solid #3D322E;
            color: #E6E1DA;
            padding: 12px 16px;
            font-size: 14px;
            border-radius: 8px;
        }
        .form-control:focus {
            background-color: #3D322E;
            border-color: #B39467;
            color: #E6E1DA;
            box-shadow: none;
        }
        .form-control::placeholder {
            color: #5C534F;
        }
        .btn-gold {
            background-color: #B39467;
            color: #1A1412;
            font-weight: 600;
            font-size: 14px;
            padding: 12px;
            border-radius: 8px;
            border: none;
            transition: transform 0.2s, background-color 0.2s;
        }
        .btn-gold:hover {
            background-color: #C5A87B;
            color: #1A1412;
            transform: translateY(-1px);
        }
        .alert-custom {
            background-color: rgba(185, 28, 28, 0.1);
            border: 1px solid #b91c1c;
            color: #f87171;
            font-size: 14px;
            border-radius: 8px;
            padding: 12px;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

    <div class="login-card">
        
        <div class="text-center mb-4">
            <h2 class="text-3xl font-bold tracking-wide mb-1">Glad Moments<span>&Co</span></h2>
            <p class="text-muted small mb-0">Sign in to Admin Dashboard</p>
        </div>

        @if($errors->has('login_error'))
            <div class="alert alert-custom text-center font-medium mb-4">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="needs-validation">
            @csrf
            
            <div class="mb-3">
                <label class="form-label mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Enter admin username" required autofocus
                    class="form-control w-100">
            </div>

            <div class="mb-4">
                <label class="form-label mb-1">Password</label>
                <input type="password" name="password" placeholder="••••••••" required
                    class="form-control w-100">
            </div>

            <div class="pt-2">
                <button type="submit" class="btn btn-gold w-100">
                    Sign In
                </button>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>