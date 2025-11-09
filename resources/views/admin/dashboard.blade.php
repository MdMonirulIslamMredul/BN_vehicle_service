@extends('layouts.app')

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
    </div>
</div>
@endsection
