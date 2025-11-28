<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BN Vehicle Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    @auth
        {{-- Include Sidebar --}}
        @include('layouts.sidebar')

        {{-- Mobile overlay --}}
        <div class="overlay" id="overlay"></div>
    @endauth

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 fixed-top" style="z-index: 1000;">
        <div class="container">
            @auth
            <button class="btn btn-dark d-lg-none me-2" id="sidebarToggle"><i class="bi bi-list"></i></button>
            @endauth
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">🚗 BN Vehicle Service</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href={{ url('/about') }}>About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href={{ url('/contact') }}>Contact</a></li>
                    @auth
                        @php
                            $user = Auth::user();
                            $dashboardRoute = match($user->role) {
                                'admin' => route('admin.dashboard'),
                                'owner' => route('owner.dashboard'),
                                'driver' => route('driver.dashboard'),
                                default => route('home'),
                            };
                            $dashboardLabel = match($user->role) {
                            'admin' => 'Admin Dashboard',
                            'owner' => 'Owner Dashboard',
                            'driver' => 'Driver Dashboard',
                            default => 'Dashboard',
                        };
                        @endphp

                        {{-- <li class="nav-item"><a class="nav-link" href="{{ $dashboardRoute }}">Dashboard</a></li> --}}

                         <!-- Dropdown for Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $user->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ $dashboardRoute }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="/profile/">My Profile</a></li>
                                <li><a class="dropdown-item" href="/profile/change-password">Change Password</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main content --}}
    <main class="container py-5 @auth dashboard-content-padding @endauth" style="margin-top: 80px;">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        if(toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });
        }

        if(overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }
    </script>

    <style>
        /* Sidebar styling */
        .sidebar {
                width: 220px;
                top: 0;
                left: 0;
                position: fixed;
                height: 100vh;
                background-color: #212529;
                padding-top: 80px;
                z-index: 999;
                transform: translateX(-100%);
                transition: 0.3s;
                overflow-y: auto;
            }

        .sidebar.show { transform: translateX(0); }

        .overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 900;
            display: none;
        }

        .overlay.show { display: block; }

        @media(min-width: 992px) {
            .sidebar { transform: translateX(0); }
            .overlay { display: none !important; }
            /* FIXED: Apply the left margin only on desktop */
            .dashboard-content-padding { margin-left: 220px; }
        }
    </style>

    @stack('scripts')
</body>
</html>
