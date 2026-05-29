<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glad Moments & Co. - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2E2A26;
            background: radial-gradient(circle at top left, rgba(255,255,255,0.98), rgba(249,245,238,0.96) 30%, rgba(242,234,222,1) 100%);
            min-height: 100vh;
        }
        h1, h2, h3, h4, h5, h6, .brand-logo {
            font-family: 'Playfair Display', serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 200;
            width: 280px;
            padding: 30px 18px 22px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: rgba(21, 17, 14, 0.95);
            border-right: 1px solid rgba(255,255,255,0.08);
            box-shadow: 12px 28px 80px rgba(16, 12, 9, 0.25);
            backdrop-filter: blur(12px);
            overflow-y: auto;
            overflow-x: hidden;
        }
        .brand-logo {
            color: #F4E9DD;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.06em;
            margin-bottom: 26px;
            text-transform: uppercase;
        }
        .brand-logo span {
            color: #D8B775;
        }
        .nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 4px;
        }
        .nav-link-admin {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 14px;
            color: #C7BAAF;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: transform 0.22s ease, background 0.22s ease, color 0.22s ease;
            background: rgba(255,255,255,0.03);
            border: 1px solid transparent;
        }
        .nav-link-admin i {
            color: #C7BAAF;
            min-width: 24px;
            text-align: center;
        }
        .nav-link-admin:hover,
        .active .nav-link-admin {
            background: linear-gradient(145deg, rgba(203, 173, 110, 0.16), rgba(255,255,255,0.08));
            color: #FFFFFF;
            transform: translateX(2px);
            border-color: rgba(255,255,255,0.12);
        }
        .active .nav-link-admin i {
            color: #F8E7C5;
        }
        .main-content {
            margin-left: 280px;
            padding: 36px 36px 52px 36px;
            min-height: 100vh;
        }
        .page-header {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
        }
        .page-header h2 {
            margin: 0 0 10px;
            font-size: clamp(1.85rem, 2.5vw, 2.6rem);
            letter-spacing: -0.03em;
            color: #1E1A18;
        }
        .page-header p {
            margin: 0;
            color: #6B645D;
            line-height: 1.8;
            max-width: 760px;
        }
        .card-custom {
            background: linear-gradient(180deg, #ffffff 0%, #faf6f0 100%);
            border: 1px solid rgba(234,229,219,0.8);
            border-radius: 22px;
            box-shadow: 0px 20px 40px rgba(76, 63, 53, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
            overflow: hidden;
        }
        .card-custom:hover {
            transform: translateY(-3px);
            border-color: rgba(209, 149, 78, 0.35);
            box-shadow: 0px 26px 60px rgba(76, 63, 53, 0.12);
        }
        .card-custom .card-body {
            padding: 1.75rem;
        }
        .btn-dark,
        .btn-primary {
            border-radius: 14px;
            padding: 0.9rem 1.5rem;
            letter-spacing: 0.01em;
            background: linear-gradient(135deg, #B39467, #8C6E44);
            border: none;
            box-shadow: 0 16px 30px rgba(179,148,103,0.18);
            transition: transform 0.25s ease, opacity 0.25s ease;
        }
        .btn-dark:hover,
        .btn-primary:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }
        .btn-outline-secondary {
            border-radius: 14px;
            border-color: rgba(34,34,34,0.12);
            color: #3D3A34;
            transition: transform 0.25s ease, background 0.25s ease, color 0.25s ease;
        }
        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            background: rgba(179,148,103,0.12);
            border-color: rgba(179,148,103,0.28);
            color: #1A1412;
        }
        .btn-sm {
            border-radius: 12px;
        }
        .alert {
            border-radius: 18px;
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 18px 36px rgba(70, 56, 44, 0.08);
            opacity: 0;
            animation: fadeInDown 0.8s ease forwards;
        }
        .alert.alert-success {
            background: linear-gradient(135deg, #F2F7EF, #EFF5E8);
            border-color: rgba(46,125,50,0.15);
        }
        .alert.alert-danger {
            background: linear-gradient(135deg, #FBE7E7, #F8E6E6);
            border-color: rgba(204, 54, 54, 0.18);
        }
        .alert ul { margin-bottom: 0; }
        .table {
            background: transparent;
        }
        .table thead th {
            background: rgba(26,20,18,0.06);
            color: #574E45;
            border-bottom: 0;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-size: .75rem;
            padding: .83rem .85rem;
        }
        .table tbody tr {
            transition: transform 0.22s ease, box-shadow 0.22s ease;
            background: rgba(255,255,255,0.92);
            border-radius: 18px;
        }
        .table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 36px rgba(80, 69, 61, 0.08);
        }
        .table td, .table th { vertical-align: middle; }
        .table td, .compact-admin-table td, .compact-admin-table th { font-size: .82rem; padding: .78rem .85rem; }
        .compact-admin-table td.text-truncate { max-width: 200px; }
        .compact-admin-table .btn-sm { padding: .35rem .55rem; }
        .compact-admin-table .badge { font-size: .72rem; padding: .45rem .7rem; }
        .form-control {
            border-radius: 14px;
            border-color: rgba(145, 125, 99, 0.2);
            box-shadow: inset 0 0 0 1px rgba(234,229,219,0.7);
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }
        .form-control:focus {
            border-color: rgba(179,148,103,0.45);
            box-shadow: 0 0 0 0.2rem rgba(179,148,103,0.12);
        }
        .badge {
            border-radius: 999px;
            letter-spacing: .04em;
            font-size: .78rem;
            padding: 0.6em 0.95em;
        }
        .badge.bg-danger {
            background: #D53A45;
            color: #fff;
            box-shadow: 0 10px 30px rgba(213, 58, 69, 0.18);
        }
        .sidebar .badge {
            background: rgba(255,255,255,0.12);
            color: #F3E5CC;
        }
        .shadow-sm { box-shadow: 0 12px 28px rgba(49, 40, 33, 0.08) !important; }
        .table-responsive { border-radius: 22px; overflow: hidden; }
        .btn-logout-sidebar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 600;
            letter-spacing: .02em;
            padding: 0.95rem 1rem;
            text-align: center;
            background-color: #bd2130;
            color: #ffffff;
            border: 1px solid #a11b28;
            box-shadow: 0 18px 36px rgba(189, 33, 48, 0.18);
            transition: transform 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-logout-sidebar:hover {
            transform: translateY(-1px);
            background-color: #a11b28;
            box-shadow: 0 20px 38px rgba(189, 33, 48, 0.24);
        }
        .sidebar-footer { position: sticky; bottom: 18px; }
        .page-notice {
            display: inline-flex;
            align-items: center;
            gap: .75rem;
            padding: .95rem 1.1rem;
            border-radius: 18px;
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(234,229,219,0.9);
            box-shadow: 0 18px 30px rgba(80, 68, 48, 0.08);
        }
        .animate-fade-in {
            opacity: 0;
            animation: fadeInUp 0.7s ease forwards;
        }
        .fade-out {
            animation: fadeOutUp 0.45s ease forwards;
        }
        .hover-lift:hover { transform: translateY(-2px); }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeOutUp {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-12px); }
        }
        @media (max-width: 1100px) {
            .sidebar { width: 240px; }
            .main-content { margin-left: 240px; padding: 30px; }
        }
        @media (max-width: 860px) {
            .sidebar { position: relative; width: 100%; height: auto; border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
            .main-content { margin-left: 0; padding: 24px; }
            .nav-link-admin { justify-content: flex-start; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="brand-logo">Glad Moments<span>&Co</span></div>
            <nav class="nav flex-column">
                <div class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link-admin">
                        <i class="fa-solid fa-chart-pie"></i> Dashboard
                    </a>
                </div>
                <div class="{{ Request::is('admin/services*') ? 'active' : '' }}">
                    <a href="{{ route('admin.services.index') }}" class="nav-link-admin">
                        <i class="fa-solid fa-camera-retro"></i> Service Management
                    </a>
                </div>
                <div class="{{ Request::is('admin/packages*') ? 'active' : '' }}">
                    <a href="{{ route('admin.packages.index') }}" class="nav-link-admin">
                        <i class="fa-solid fa-box-open"></i> Package Management
                    </a>
                </div>
                <div class="{{ Request::is('admin/schedules*') ? 'active' : '' }}">
                    <a href="{{ route('admin.schedules.index') }}" class="nav-link-admin">
                        <i class="fa-solid fa-calendar-days"></i> Schedule Management
                    </a>
                </div>
                <div class="{{ Request::is('admin/portfolios*') ? 'active' : '' }}">
                    <a href="{{ route('admin.portfolios.index') }}" class="nav-link-admin">
                        <i class="fa-solid fa-images"></i> Portfolio Management
                    </a>
                </div>
                <div class="{{ Request::is('admin/highlights*') ? 'active' : '' }}">
                    <a href="{{ route('admin.highlights.index') }}" class="nav-link-admin">
                        <i class="fa-solid fa-star"></i> Highlight Management
                    </a>
                </div>
                <div class="{{ Request::is('admin/promos*') ? 'active' : '' }}">
                    <a href="{{ route('admin.promos.index') }}" class="nav-link-admin">
                        <i class="fa-solid fa-tag"></i> Promo Management
                    </a>
                </div>
                <div class="{{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonials.index') }}" class="nav-link-admin">
                        <i class="fa-solid fa-comment-dots"></i> Testimonial Management
                    </a>
                </div>
                <div class="{{ Request::is('admin/bookings*') ? 'active' : '' }}">
                    <a href="{{ route('admin.bookings.index') }}" class="nav-link-admin d-flex justify-content-between align-items-center">
                        <span><i class="fa-solid fa-calendar-check"></i> Booking Management</span>
                        <span id="booking-badge-sidebar" class="badge bg-danger rounded-pill d-none">0</span>
                    </a>
                </div>
            </nav>
        </div>

        <div class="px-3 sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                @csrf
                <button type="submit" class="btn btn-logout-sidebar w-100 btn-sm p-2 text-start d-flex align-items-center">
                    <i class="fa-solid fa-right-from-bracket me-2 ms-1"></i> 
                    <span>Logout Admin</span>
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <div class="fw-bold mb-2">Gagal menyimpan karena:</div>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function checkNewBookings() {
            fetch('{{ route("admin.bookings.new_count") }}')
                .then(response => {
                    if (response.ok) return response.json();
                    throw new Error('Unauthorized');
                })
                .then(data => {
                    const badge = document.getElementById('booking-badge-sidebar');
                    if (badge) {
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.classList.remove('d-none');
                        } else {
                            badge.classList.add('d-none');
                        }
                    }
                })
                .catch(err => console.log('Booking count check omitted or unauthorized.'));
        }
        function showToast(message, type = 'success') {
            let container = document.getElementById('admin-toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'admin-toast-container';
                Object.assign(container.style, {
                    position: 'fixed',
                    top: '24px',
                    right: '24px',
                    zIndex: '9999',
                    display: 'flex',
                    flexDirection: 'column',
                    gap: '12px',
                    alignItems: 'flex-end'
                });
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            toast.className = 'alert alert-' + (type === 'success' ? 'success' : (type === 'danger' ? 'danger' : 'info')) + ' animate-fade-in';
            toast.style.minWidth = '320px';
            toast.style.maxWidth = '420px';
            toast.style.padding = '1rem 1.25rem';
            toast.innerHTML = `
                <div class="d-flex align-items-center justify-content-between gap-3">
                    <div class="me-2">${message}</div>
                    <button type="button" class="btn-close btn-close-white" aria-label="Close"></button>
                </div>
            `;
            container.appendChild(toast);

            toast.querySelector('.btn-close').addEventListener('click', () => {
                toast.classList.add('fade-out');
                setTimeout(() => toast.remove(), 500);
            });

            setTimeout(() => {
                toast.classList.add('fade-out');
                setTimeout(() => toast.remove(), 500);
            }, 5200);
        }

        document.addEventListener('DOMContentLoaded', () => {
            checkNewBookings();
            setInterval(checkNewBookings, 10000); // Check every 10 seconds

            document.querySelectorAll('.alert').forEach((alert, idx) => {
                alert.style.animationDelay = `${idx * 100}ms`;
                if (alert.classList.contains('alert-success') || alert.classList.contains('alert-info')) {
                    setTimeout(() => alert.classList.add('fade-out'), 5000);
                }
            });
        });
    </script>
</body>
</html>