@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Vehicle</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('vehicles.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="chassis_number" class="form-label">Chassis Number</label>
                    <input type="text" name="chassis_number" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="registration_number" class="form-label">Registration Number</label>
                    <input type="text" name="registration_number" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="make" class="form-label">Company</label>
                    <input type="text" name="make" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" name="model" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="text" name="year" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" name="color" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Save Vehicle</button>
                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
