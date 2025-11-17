@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <h2 class="fw-bold mb-2 mb-md-0 text-center text-md-start">Appointments List</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            ← Back to Dashboard
        </a>
    </div>

    {{-- Filter dropdown --}}
    <div class="d-flex justify-content-end align-items-center mb-3">
        <form method="GET" action="{{ route('admin.appointments') }}" class="d-flex">
            <select name="status" class="form-select me-2" onchange="this.form.submit()">
                <option value="all" {{ ($filter ?? 'all') == 'all' ? 'selected' : '' }}>All</option>
                <option value="not_connected" {{ ($filter ?? '') == 'not_connected' ? 'selected' : '' }}>Not Connected</option>
                <option value="connected" {{ ($filter ?? '') == 'connected' ? 'selected' : '' }}>Connected</option>
            </select>
            <noscript><button type="submit" class="btn btn-primary">Search</button></noscript>
        </form>
    </div>

    @if(request('status') && request('status') !== 'all')
        <a href="{{ route('admin.appointments') }}" class="btn btn-sm btn-outline-secondary mb-3">Reset Filter</a>
    @endif

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- TABLE VIEW (desktop) --}}
    <div class="table-responsive shadow-sm rounded d-none d-md-block">
        <table class="table table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Appointment Date</th>
                    <th>Car Brand</th>
                    <th>Car Model</th>
                    <th>Car Number</th>
                    <th>Services</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $index => $appointment)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->phone }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->date->format('d M, Y') }}</td>
                        <td>{{ $appointment->brand }}</td>
                        <td>{{ $appointment->model }}</td>
                        <td>{{ $appointment->number }}</td>
                        <td>
                            @if(is_array($appointment->services) && count($appointment->services))
                                @foreach($appointment->services as $service)
                                    <span class="badge bg-warning text-dark">{{ $service }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ $appointment->created_at->format('d M, Y h:i A') }}</td>
                        <td>
                            <span class="badge {{ $appointment->status === 'connected' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.appointments.status', $appointment->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $appointment->status === 'connected' ? 'btn-warning' : 'btn-success' }}">
                                    {{ $appointment->status === 'connected' ? 'Mark as Not Connected' : 'Mark as Connected' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- CARD VIEW (mobile) --}}
    <div class="d-block d-md-none">
        @forelse ($appointments as $index => $appointment)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-2">{{ $appointment->name }}</h5>
                        <span class="badge {{ $appointment->status === 'connected' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>

                    <p class="mb-1"><strong>Phone:</strong> {{ $appointment->phone }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $appointment->email ?? '—' }}</p>
                    <p class="mb-1"><strong>Date:</strong> {{ $appointment->date->format('d M, Y') }}</p>
                    <p class="mb-1"><strong>Car:</strong> {{ $appointment->brand }} {{ $appointment->model }} ({{ $appointment->number }})</p>
                    <p class="mb-1"><strong>Services:</strong>
                        @if(is_array($appointment->services) && count($appointment->services))
                            @foreach($appointment->services as $service)
                                <span class="badge bg-warning text-dark">{{ $service }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </p>
                    <p class="mb-2"><strong>Created:</strong> {{ $appointment->created_at->format('d M, Y h:i A') }}</p>

                    <form action="{{ route('admin.appointments.status', $appointment->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-sm w-100 {{ $appointment->status === 'connected' ? 'btn-warning' : 'btn-success' }}">
                            {{ $appointment->status === 'connected' ? 'Mark as Not Connected' : 'Mark as Connected' }}
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">No appointments found.</div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $appointments->links() }}
    </div>
</div>
@endsection
