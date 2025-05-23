<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Waste Info</title>

    <!-- Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }
        .sidebar {
            background-color: #d1fae5;
            width: 230px;
            min-height: 100vh;
            position: fixed;
            padding: 24px 16px;
            transition: all 0.3s;
        }
        .sidebar h5 {
            font-weight: 600;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            color: #065f46;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            transition: background-color 0.2s ease-in-out;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #bbf7d0;
            color: #065f46;
        }
        .main-content {
            margin-left: 230px;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar">
            <h5 class="text-success mb-4"><i class="bi bi-recycle"></i> Waste Info</h5>

            <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('schedules.index') }}" class="{{ request()->is('schedules*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i> Jadwal
            </a>
            <a href="{{ route('reports.index') }}" class="{{ request()->is('reports*') ? 'active' : '' }}">
                <i class="bi bi-envelope-paper"></i> Laporan
            </a>
            <a href="{{ route('areas.index') }}" class="{{ request()->is('areas*') ? 'active' : '' }}">
                <i class="bi bi-geo-alt"></i> Wilayah
            </a>
            <a href="{{ route('trash-types.index') }}" class="{{ request()->is('trash-types*') ? 'active' : '' }}">
                <i class="bi bi-recycle"></i> Jenis Sampah
            </a>

            <hr>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger w-100 mt-2">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

        {{-- Main Content --}}
        <div class="main-content w-100">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
