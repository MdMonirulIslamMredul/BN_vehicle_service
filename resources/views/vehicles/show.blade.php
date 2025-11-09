@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Vehicle Details</h3>
    <p><strong>Make:</strong> {{ $vehicle->make }}</p>
    <p><strong>Model:</strong> {{ $vehicle->model }}</p>
    <p><strong>Year:</strong> {{ $vehicle->year }}</p>
    <p><strong>Plate Number:</strong> {{ $vehicle->plate_number }}</p>

    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
