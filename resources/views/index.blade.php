
@extends('layouts.app_home')

@section('content')
<!-- Hero Section -->
<section class="hero position-relative text-white"
    style="background: url('{{ asset('images/hero-bg.png') }}') center/cover no-repeat; height: 85vh;">
    <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75"></div>
    <div class="container h-100 d-flex align-items-center justify-content-center text-center position-relative">
        <div>
            <h1 class="display-4 fw-bold mb-3">Welcome to BN Vehicle Service</h1>
            <p class="lead mb-4">Your trusted partner for vehicle maintenance and repair</p>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-warning btn-lg rounded-pill px-4 py-2">Get Started</a>
                @else
                    <a href="{{ route('home') }}" class="btn btn-success px-4 py-2">Go to Dashboard</a>

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

                @endguest

        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">About Us</h2>
        <p class="mx-auto" style="max-width: 700px;">
            We are dedicated to providing high-quality automobile services including repair, maintenance,
            and vehicle care. Our skilled team ensures your vehicle performs its best.
        </p>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Our Services</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow h-100">
                    <img src="{{ asset('images/service1.jpg') }}" class="card-img-top" alt="Repair Service">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Vehicle Repair</h5>
                        <p class="card-text">Complete vehicle repair solutions by experienced professionals.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow h-100">
                    <img src="{{ asset('images/service2.jpg') }}" class="card-img-top" alt="Maintenance">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Maintenance</h5>
                        <p class="card-text">Regular checkups and maintenance to ensure your vehicle runs smoothly.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow h-100">
                    <img src="{{ asset('images/service3.jpg') }}" class="card-img-top" alt="Parts Replacement">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Parts Replacement</h5>
                        <p class="card-text">Genuine parts replacement with warranty and quality assurance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Book Appointment Section -->
<section id="appointment" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Book an Appointment</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
               <form action="{{ route('appointments.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name *</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone *</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date You Want To Service*</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>

    <div class="mb-3">
        <label for="brand" class="form-label">Car Brand *</label>
        <input type="text" class="form-control" id="brand" name="brand" required>
    </div>

    <div class="mb-3">
        <label for="model" class="form-label">Car Model *</label>
        <input type="text" class="form-control" id="model" name="model" required>
    </div>

    <div class="mb-3">
        <label for="number" class="form-label">Car Number *</label>
        <input type="text" class="form-control" id="number" name="number" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Services</label>
        <select name="services[]" class="form-select" multiple required>
            <option value="Full Inspection">Full Inspection</option>
            <option value="Repair">Repair</option>
            <option value="Maintenance">Maintenance</option>
            <option value="Oil Change">Oil Change</option>
            <option value="Wheel Alignment">Wheel Alignment</option>
        </select>
        <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple</small>
    </div>

    <button type="submit" class="btn btn-primary">Book Appointment</button>
</form>

            </div>
        </div>
    </div>
</section>


<!-- Call to Action -->
<section class="py-5 bg-warning text-dark text-center">
    <div class="container">
        <h3 class="fw-bold mb-3">Need Vehicle Assistance?</h3>
        <p class="mb-4">Book your vehicle service appointment today and experience reliable care.</p>
        <a href="{{ route('service-requests.create') }}" class="btn btn-dark btn-lg rounded-pill px-4">Book Now</a>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Contact Us</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <p><i class="bi bi-geo-alt-fill text-warning"></i>  Bangladesh</p>
                <p><i class="bi bi-telephone-fill text-warning"></i> +880 1234 567890</p>
                <p><i class="bi bi-envelope-fill text-warning"></i> info@bnvehicleservice.com</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <small>© {{ date('Y') }} BN Vehicle Service. All rights reserved.</small>
</footer>
@endsection
