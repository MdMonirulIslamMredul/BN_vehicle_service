{{-- @extends('layouts.addsidebar')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">Admin Dashboard</h3>

    <div class="row">
        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Manage Users</h5>
                        <p class="card-text">View, edit, and delete users.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.vehicles') }}" class="text-decoration-none">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Manage Vehicles</h5>
                        <p class="card-text">View all vehicles in the system.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.service_requests') }}" class="text-decoration-none">
                <div class="card text-white bg-warning shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Service Requests</h5>
                        <p class="card-text">Assign drivers and track requests.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="{{ route('admin.appointments') }}" class="text-decoration-none">
                <div class="card text-white bg-danger shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">View Appointments</h5>
                        <p class="card-text">Manage all vehicle service appointments.</p>
                    </div>
                </div>
            </a>
        </div>


    </div>
</div>
@endsection --}}

@extends('layouts.app')
@section('content')


<div class="container py-5">
    <h2 class="text-center mb-4">Admin Dashboard</h2>

    <div class="row g-3">
        <div class="col-12 col-md-6 col-lg-3">
            <a href="{{ route('admin.users') }}" class="card text-white bg-primary h-100 text-decoration-none">
                <div class="card-body">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">View, edit, and delete users.</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <a href="{{ route('admin.vehicles') }}" class="card text-white bg-success h-100 text-decoration-none">
                <div class="card-body">
                    <h5 class="card-title">Manage Vehicles</h5>
                    <p class="card-text">View all vehicles in the system.</p>
                </div>
            </a>
        </div>



        <div class="col-12 col-md-6 col-lg-3">
            <a href="{{ route('admin.appointments') }}" class="card text-white bg-danger h-100 text-decoration-none">
                <div class="card-body">
                    <h5 class="card-title">View Appointments</h5>
                    <p class="card-text">Manage all vehicle service appointments.</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <a href="{{ route('admin.services.create') }}" class="card text-white bg-warning h-100 text-decoration-none">
                <div class="card-body">
                    <h5 class="card-title"> Add New Service </h5>
                    <p class="card-text">Assign drivers and track requests.</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <a href="{{ route('admin.services.index') }}" class="card text-white bg-info h-100 text-decoration-none">
                <div class="card-body">
                    <h5 class="card-title">All Services List</h5>
                    <p class="card-text">Manage service records and operations.</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <a href="{{ route('admin.services.index', ['status' => 'pending']) }}" class="card text-white bg-secondary h-100 text-decoration-none">
                <div class="card-body">
                    <h5 class="card-title">Pending Services</h5>
                    <p class="card-text">View all pending service requests.</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <a href="{{ route('admin.services.index', ['status' => 'finished']) }}" class="card text-white bg-success h-100 text-decoration-none">
                <div class="card-body">
                    <h5 class="card-title">Services Done List</h5>
                    <p class="card-text">View all completed services.</p>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
