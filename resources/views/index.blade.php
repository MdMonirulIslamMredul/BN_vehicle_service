@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class="fw-bold text-primary mb-3">Welcome to Vehicle Servicing Portal</h1>
    <p class="lead mb-4">Manage your vehicle maintenance, service requests, and driver info in one place.</p>

    @guest
        <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary px-4 py-2">Register</a>
    @else
        {{-- <a href="{{ route('home') }}" class="btn btn-success px-4 py-2">Go to Dashboard</a> --}}
         {{-- ✅ Role-Based Dashboard Link --}}
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

                        <a class="btn btn-success px-4 py-2" href="{{ $dashboardRoute }}"> {{ $dashboardLabel }}</a>

    @endguest
</div>
@endsection
