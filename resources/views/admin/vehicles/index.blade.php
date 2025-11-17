@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    {{-- Header + Back Button --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-2 mb-md-0 text-center text-md-start">All Vehicles</h3>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            ← Back to Dashboard
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTERS & SEARCH (like Appointments) --}}
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.vehicles') }}" class="row g-3">
                <div class="col-md-6">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search"
                           value="{{ $search ?? '' }}" placeholder="Chassis No or Registration No" autocomplete="off">
                    <div id="liveVehicleResults" class="position-absolute w-100 bg-white border rounded shadow-sm"
                         style="z-index:1000; display:none;"></div>
                </div>
                <div class="col-md-4">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" onchange="this.form.submit()">
                        <option value="all" {{ (!isset($role) || $role === 'all') ? 'selected' : '' }}>All</option>
                        <option value="owner" {{ (isset($role) && $role === 'owner') ? 'selected' : '' }}>Owner</option>
                        <option value="driver" {{ (isset($role) && $role === 'driver') ? 'selected' : '' }}>Driver</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
            @php
                $hasFilter = (request('role') && request('role') !== 'all') || (request('search'));
            @endphp
            @if($hasFilter)
                <a href="{{ route('admin.vehicles') }}" class="btn btn-sm btn-outline-secondary mt-3">Reset Filter</a>
            @endif
        </div>
    </div>

    {{-- No Vehicles --}}
    @if($vehicles->isEmpty())
        <div class="alert alert-info text-center">No vehicles found.</div>
    @else
        {{-- TABLE (desktop view) --}}
        <div class="table-responsive shadow-sm rounded d-none d-md-block">
            <table class="table table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Owner/Driver</th>
                        <th>Role</th>
                        <th>Chassis No</th>
                        <th>Registration No</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $index => $vehicle)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $vehicle->user->name ?? 'N/A' }}</td>
                            <td>
                                @if(optional($vehicle->user)->role === 'owner')
                                    <span class="badge bg-success text-uppercase">Owner</span>
                                @elseif(optional($vehicle->user)->role === 'driver')
                                    <span class="badge bg-warning text-dark text-uppercase">Driver</span>
                                @else
                                    <span class="badge bg-secondary text-uppercase">N/A</span>
                                @endif
                            </td>
                            <td>{{ $vehicle->chassis_number }}</td>
                            <td>{{ $vehicle->registration_number }}</td>
                            <td>{{ $vehicle->make }}</td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->year }}</td>
                            <td>{{ $vehicle->created_at ? $vehicle->created_at->format('d M Y, h:i A') : '—' }}</td>
                            <td>
                                {{-- Action buttons --}}
                                {{-- <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Delete this vehicle?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- CARDS (mobile view) --}}
        <div class="d-block d-md-none">
            @foreach ($vehicles as $index => $vehicle)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-2">
                            {{ $vehicle->make }} {{ $vehicle->model }}
                            <span class="badge bg-secondary float-end">#{{ $index + 1 }}</span>
                        </h5>
                        <p class="mb-1"><strong>Owner/Driver:</strong> {{ $vehicle->user->name ?? 'N/A' }}</p>
                        <p class="mb-1">
                            <strong>Role:</strong>
                            @if(optional($vehicle->user)->role === 'owner')
                                <span class="badge bg-success text-uppercase">Owner</span>
                            @elseif(optional($vehicle->user)->role === 'driver')
                                <span class="badge bg-warning text-dark text-uppercase">Driver</span>
                            @else
                                <span class="badge bg-secondary text-uppercase">N/A</span>
                            @endif
                        </p>
                        <p class="mb-1"><strong>Chassis No:</strong> {{ $vehicle->chassis_number }}</p>
                        <p class="mb-1"><strong>Registration No:</strong> {{ $vehicle->registration_number }}</p>
                        <p class="mb-1"><strong>Year:</strong> {{ $vehicle->year }}</p>
                        <p class="mb-2"><strong>Date:</strong> {{ $vehicle->created_at ? $vehicle->created_at->format('d M Y, h:i A') : '—' }}</p>

                        {{-- Action buttons --}}
                        {{-- <a href="#" class="btn btn-sm btn-outline-danger">Delete</a> --}}
                    </div>
                </div>
            @endforeach
        </div>
    @endif

     {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $vehicles->links() }}
    </div>

</div>
@endsection

@push('scripts')
<script>
(function() {
    const searchInput = document.getElementById('search');
    const resultsBox = document.getElementById('liveVehicleResults');
    let timer;
    let lastQuery = '';

    function hideResults() {
        resultsBox.style.display = 'none';
        resultsBox.innerHTML = '';
    }

    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        if (!query) {
            hideResults();
            return;
        }
        clearTimeout(timer);
        timer = setTimeout(() => {
            lastQuery = query;
            const role = document.getElementById('role')?.value || '';
            fetch(`{{ route('admin.vehicles.live_search') }}?search=${encodeURIComponent(query)}&role=${encodeURIComponent(role)}`)
                .then(res => res.json())
                .then(data => {
                    resultsBox.innerHTML = data.html;
                    resultsBox.style.display = 'block';
                });
        }, 300);
    });

    searchInput.addEventListener('blur', function() {
        setTimeout(hideResults, 200);
    });

    resultsBox.addEventListener('mousedown', function(e) {
        e.preventDefault();
    });
})();
</script>
@endpush
