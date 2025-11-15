<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BN Vehicle Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero { position: relative; }
        .hero .overlay { z-index: 1; }
        .hero > .container { z-index: 2; }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}"> 🚗 BN Vehicle Service</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href={{ url('/about') }}>About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
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

                     <!-- Dropdown for Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $user->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- <li><a class="dropdown-item" href="{{ $dashboardRoute }}">{{ $dashboardLabel }}</a></li> --}}
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
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
      <!-- Page content -->

    {{-- <main class="container py-5">
        @yield('content')
    </main> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
