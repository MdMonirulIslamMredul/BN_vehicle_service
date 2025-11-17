@if($vehicles->count())
    <ul class="list-group">
        @foreach($vehicles as $vehicle)
            <li class="list-group-item d-flex align-items-center">
                <span class="me-2 fw-bold">{{ $vehicle->chassis_number }}</span>
                <span class="me-2 text-muted">{{ $vehicle->registration_number }}</span>
                <span class="me-2 text-muted">{{ $vehicle->user->name ?? 'N/A' }}</span>
                <span class="badge bg-{{ optional($vehicle->user)->role === 'owner' ? 'success' : (optional($vehicle->user)->role === 'driver' ? 'warning' : 'secondary') }} text-uppercase">{{ optional($vehicle->user)->role ?? 'N/A' }}</span>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('admin.vehicles', array_filter(['search' => request('search'), 'role' => request('role')])) }}" class="d-block text-center mt-2 small text-primary">See all results</a>
@else
    <div class="text-muted p-2">No vehicles found.</div>
@endif
