@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
        <h2 class="fw-bold mb-2 mb-md-0 text-center text-md-start">User List</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ">
            ← Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- DESKTOP TABLE VIEW --}}
    <div class="table-responsive shadow-sm rounded d-none d-md-block">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>License Number</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->license_number }}</td>
                        <td>
                            @php
                                $color = match($user->role) {
                                    'owner' => 'success',   // green
                                    'driver' => 'warning',  // yellow
                                    'admin' => 'danger',    // red
                                    default => 'secondary', // gray
                                };
                            @endphp
                            <span class="badge bg-{{ $color }} text-uppercase">{{ $user->role }}</span>
                        </td>
                        <td>{{ $user->created_at ? $user->created_at->format('d M, Y h:i A') : '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- MOBILE CARD VIEW --}}
    <div class="d-block d-md-none">
        @forelse ($users as $user)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">{{ $user->name }}</h5>
                        @php
                            $color = match($user->role) {
                                'owner' => 'success',
                                'driver' => 'warning',
                                'admin' => 'danger',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $color }} text-uppercase">{{ $user->role }}</span>
                    </div>
                    <p class="mb-1"><strong>Phone:</strong> {{ $user->phone }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-1"><strong>Address:</strong> {{ $user->address ?? '—' }}</p>
                    <p class="mb-1"><strong>License:</strong> {{ $user->license_number ?? '—' }}</p>
                    <p class="mb-0"><strong>Created:</strong> {{ $user->created_at ? $user->created_at->format('d M, Y h:i A') : '—' }}</p>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">No users found.</div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
