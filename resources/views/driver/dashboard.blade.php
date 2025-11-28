@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">Driver Dashboard</h3>

    <div class="row">

        <div class="col-md-6 mb-3">
            <a href="{{ route('vehicles.index') }}" class="text-decoration-none">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Vehicle List</h5>
                        <p class="card-text">View all your Vehicle </p>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-6 mb-3">
            <a href="/profile" class="text-decoration-none">
                <div class="card text-white bg-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">My Profile</h5>
                        <p class="card-text">View and update your profile.</p>
                    </div>
                </div>
            </a>
        </div>

         {{-- <div class="col-md-6 mb-3">
            <a href="{{ route('service-requests.index') }}" class="text-decoration-none">
                <div class="card text-white bg-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">My Assigned Requests</h5>
                        <p class="card-text">View service requests assigned to you.</p>
                    </div>
                </div>
            </a>
        </div> --}}

        <div class="col-md-6 mb-3">
            <a href="{{ route('my.services') }}" class="text-decoration-none">
                <div class="card text-white bg-info shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">My Services</h5>
                        <p class="card-text">Track your service status</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection
