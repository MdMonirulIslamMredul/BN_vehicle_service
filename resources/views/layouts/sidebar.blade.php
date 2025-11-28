<div class="sidebar bg-dark text-white position-fixed h-100 p-3" id="sidebar">

    {{-- Assuming Auth::user() is available here --}}
    @php
        $user = Auth::user();
    @endphp

    <h4 class="text-center py-3 border-bottom">{{ ucfirst($user->role) }} Panel</h4>

    @if ($user->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('admin.dashboard') ? 'bg-primary' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('admin.users') ? 'bg-primary' : '' }}">
            <i class="bi bi-people me-2"></i> Users
        </a>
        <a href="{{ route('admin.vehicles') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('admin.vehicles') ? 'bg-primary' : '' }}">
            <i class="bi bi-truck me-2"></i> Vehicles
        </a>
        <a href="{{ route('admin.appointments') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('admin.appointments') ? 'bg-primary' : '' }}">
            <i class="bi bi-calendar-check me-2"></i> Appointments
        </a>
        <a href="{{ route('admin.services.create') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('admin.services.create') ? 'bg-primary' : '' }}">
            <i class="bi bi-plus-circle me-2"></i> Add New Service
        </a>
        <a href="{{ route('admin.services.index') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('admin.services.index') && !request()->has('status') ? 'bg-primary' : '' }}">
            <i class="bi bi-list-ul me-2"></i> All Services List
        </a>
        <a href="{{ route('admin.services.index', ['status' => 'pending']) }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->get('status') === 'pending' ? 'bg-primary' : '' }}">
            <i class="bi bi-clock-history me-2"></i> Pending Services
        </a>
        <a href="{{ route('admin.services.index', ['status' => 'finished']) }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->get('status') === 'finished' ? 'bg-primary' : '' }}">
            <i class="bi bi-check-circle me-2"></i> Services Done List
        </a>

    @elseif ($user->role === 'owner')
        <a href="{{ route('owner.dashboard') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('owner.dashboard') ? 'bg-primary' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ route('vehicles.index') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('owner.vehicles') ? 'bg-primary' : '' }}">
            <i class="bi bi-truck me-2"></i> My Vehicles
        </a>
        {{-- <a href="#" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('owner.requests') ? 'bg-primary' : '' }}">
            <i class="bi bi-list-check me-2"></i> Service Requests
        </a> --}}
        <a href="{{ route('my.services') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('owner.services') ? 'bg-primary' : '' }}">
            <i class="bi bi-gear-wide-connected me-2"></i> My Services
        </a>


        {{-- Add other owner-specific links here --}}

    @elseif ($user->role === 'driver')
        <a href="{{ route('driver.dashboard') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('driver.dashboard') ? 'bg-primary' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ route('vehicles.index') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('owner.vehicles') ? 'bg-primary' : '' }}">
            <i class="bi bi-truck me-2"></i> My Vehicles
        </a>
        {{-- <a href="#" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('driver.assigned') ? 'bg-primary' : '' }}">
            <i class="bi bi-geo-alt me-2"></i> My Assignments
        </a> --}}
        <a href="{{ route('my.services') }}" class="d-block text-white py-2 px-3 text-decoration-none {{ request()->routeIs('driver.services') ? 'bg-primary' : '' }}">
            <i class="bi bi-gear-wide-connected me-2"></i> My Services
        </a>
        {{-- Add other driver-specific links here --}}

    @endif

    <form action="{{ route('logout') }}" method="POST" class="mt-4 px-3">
        @csrf
        <button class="btn btn-danger w-100"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
    </form>
</div>
