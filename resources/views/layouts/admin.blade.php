<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BN Vehicle Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 220px;
            background-color: #212529;
            color: #fff;
            z-index: 1000;
            transition: all 0.3s;
            padding-top: 60px; /* space for top navbar */
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #343a40;
            color: #fff;
        }

        .sidebar .active {
            background-color: #0d6efd;
        }

        /* Top navbar */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 220px;
            right: 0;
            height: 60px;
            z-index: 1100;
        }

        /* Content */
        .content {
            margin-left: 220px;
            padding: 80px 20px 20px 20px; /* top padding for navbar */
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        /* Overlay for mobile sidebar */
        .overlay {
            position: fixed;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            transition: all 0.3s;
        }

        .overlay.show {
            left: 0;
        }

        /* Mobile adjustments */
        @media (max-width: 992px) {
            .sidebar {
                left: -220px;
            }
            .sidebar.show {
                left: 0;
            }
            .top-navbar {
                left: 0;
            }
            .content {
                margin-left: 0;
                padding-top: 80px;
            }
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar" id="sidebar">
        <h4 class="text-center py-3 border-bottom">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}"><i class="bi bi-people me-2"></i> Users</a>
        <a href="{{ route('admin.vehicles') }}" class="{{ request()->routeIs('admin.vehicles') ? 'active' : '' }}"><i class="bi bi-truck me-2"></i> Vehicles</a>
        <a href="{{ route('admin.appointments') }}" class="{{ request()->routeIs('admin.appointments') ? 'active' : '' }}"><i class="bi bi-calendar-check me-2"></i> Appointments</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-3 px-3">
            @csrf
            <button class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
        </form>
    </div>

    <div class="overlay" id="overlay"></div>

    {{-- Top Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark top-navbar">
        <div class="container-fluid">
            <button class="btn btn-dark d-lg-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
            <a class="navbar-brand ms-2" href="{{ route('admin.dashboard') }}"> 🚗 BN Vehicle Service</a>
        </div>



                        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
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
                            'admin' => ' Dashboard',
                            'owner' => ' Dashboard',
                            'driver' => ' Dashboard',
                            default => 'Dashboard',
                        };
                    @endphp
                    <li class="nav-item"><a class="nav-link" href="{{ $dashboardRoute }}">{{ $dashboardLabel }}</a></li>

                     <!-- Dropdown for Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $user->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ $dashboardRoute }}">{{ $dashboardLabel }}</a></li>
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
                        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('profile.show') }}">Profile</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="nav-link bg-transparent border-0 text-white">Logout</button>
                            </form>
                        </li> --}}


                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                         <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
    </nav>


    {{-- Page content --}}
    <main class="content">
        @yield('content')
    </main>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>
</body>
</html>
