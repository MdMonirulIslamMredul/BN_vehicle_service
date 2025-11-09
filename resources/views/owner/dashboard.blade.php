@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">Owner Dashboard</h3>

    <div class="mb-3">
        <a href="{{ route('vehicles.index') }}" class="btn btn-primary"> Vehicle List</a>
        <a href="{{ route('service-requests.index') }}" class="btn btn-success">View My Service Requests</a>
    </div>

    {{-- <div class="row mt-3">
        @forelse(Auth::user()->vehicles as $vehicle)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $vehicle->registration_number }}</h5>
                    <p class="card-text">
                        <strong>Chassis:</strong> {{ $vehicle->chassis_number }}<br>
                        <strong>Make:</strong> {{ $vehicle->make ?? 'N/A' }}<br>
                        <strong>Model:</strong> {{ $vehicle->model ?? 'N/A' }}<br>
                        <strong>Year:</strong> {{ $vehicle->year ?? 'N/A' }}
                    </p>
                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info">You have no vehicles added yet.</div>
        @endforelse
    </div> --}}
</div>
@endsection
