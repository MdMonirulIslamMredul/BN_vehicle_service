@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">My Vehicles</h3>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">+ Add Vehicle</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($vehicles->isEmpty())
        <div class="alert alert-info">You haven’t added any vehicles yet.</div>
    @else
        <div class="row">
            @foreach($vehicles as $vehicle)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $vehicle->registration_number }}</h5>
                            <p class="card-text">
                                <strong>Chassis:</strong> {{ $vehicle->chassis_number }} <br>
                                <strong>Make:</strong> {{ $vehicle->make ?? 'N/A' }} <br>
                                <strong>Model:</strong> {{ $vehicle->model ?? 'N/A' }} <br>
                                <strong>Year:</strong> {{ $vehicle->year ?? 'N/A' }}
                            </p>
                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary">Edit Info</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
