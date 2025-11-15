@extends('layouts.app_home')

@section('content')
<div class="container py-5">
    <h1 class="text-center fw-bold mb-4">Contact Us</h1>
    <p class="lead text-center text-muted mb-5">We're here to assist you with your Nitol-Tata vehicle service and fleet management needs.</p>

    <div class="row">
        <div class="col-lg-5 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-primary">Reach Out Directly</h4>

                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-geo-alt-fill fs-4 me-3 text-danger"></i>
                        <div>
                            <p class="mb-0 fw-bold">Location</p>
                            <p class="text-muted">Bangladesh</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-telephone-fill fs-4 me-3 text-success"></i>
                        <div>
                            <p class="mb-0 fw-bold">Phone Number</p>
                            <p class="text-muted">+880 1234 567890</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-envelope-fill fs-4 me-3 text-info"></i>
                        <div>
                            <p class="mb-0 fw-bold">Email Address</p>
                            <p class="text-muted">info@bnvehicleservice.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-primary">Book an Appointment</h4>

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
    </div>
</div>
@endsection
