@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Vehicle</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehicles.update', $vehicle) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="chassis_number" class="form-label">Chassis Number</label>
            <input type="text" name="chassis_number" value="{{ old('chassis_number', $vehicle->chassis_number) }}"
                   class="form-control @error('chassis_number') is-invalid @enderror" required>
            @error('chassis_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="registration_number" class="form-label">Registration Number</label>
            <input type="text" name="registration_number" value="{{ old('registration_number', $vehicle->registration_number) }}"
                   class="form-control @error('registration_number') is-invalid @enderror" required>
            @error('registration_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Company</label>
            <input type="text" name="make" value="{{ old('make', $vehicle->make) }}"
                   class="form-control @error('make') is-invalid @enderror" required>
            @error('make')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Model</label>
            <input type="text" name="model" value="{{ old('model', $vehicle->model) }}"
                   class="form-control @error('model') is-invalid @enderror" required>
            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Year</label>
            <input type="text" name="year" value="{{ old('year', $vehicle->year) }}"
                   class="form-control @error('year') is-invalid @enderror" required>
            @error('year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

         <div class="mb-3">
            <label>Color</label>
            <input type="text" name="color" value="{{ old('color', $vehicle->color) }}"
                   class="form-control @error('color') is-invalid @enderror" required>
            @error('color')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <button class="btn btn-primary">Update</button>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
