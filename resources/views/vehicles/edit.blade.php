@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Vehicle</h2>

    <form action="{{ route('vehicles.update', $vehicle) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="chassis_number" class="form-label">Chassis Number</label>
            <input type="text" name="chassis_number" value="{{ $vehicle->chassis_number }}"  class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="registration_number" class="form-label">Registration Number</label>
            <input type="text" name="registration_number" value="{{ $vehicle->registration_number }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Company</label>
            <input type="text" name="make" value="{{ $vehicle->make }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Model</label>
            <input type="text" name="model" value="{{ $vehicle->model }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Year</label>
            <input type="text" name="year" value="{{ $vehicle->year }}" class="form-control" required>
        </div>

         <div class="mb-3">
            <label>Color</label>
            <input type="text" name="color" value="{{ $vehicle->color }}" class="form-control" required>
        </div>



        <button class="btn btn-primary">Update</button>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
