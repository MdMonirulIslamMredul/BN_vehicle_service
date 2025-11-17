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
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FILTERS & SEARCH (like Appointments) --}}
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.users') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search"
                           value="{{ $search ?? '' }}" placeholder="Name, Email, or Phone" autocomplete="off">
                    <div id="liveUserResults" class="position-absolute w-100 bg-white border rounded shadow-sm" style="z-index:1000; display:none;"></div>
                </div>
                <div class="col-md-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" onchange="this.form.submit()">
                        <option value="all" {{ (!isset($role) || $role === 'all') ? 'selected' : '' }}>All Roles</option>
                        <option value="owner" {{ (isset($role) && $role === 'owner') ? 'selected' : '' }}>Owner</option>
                        <option value="driver" {{ (isset($role) && $role === 'driver') ? 'selected' : '' }}>Driver</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" onchange="this.form.submit()">
                        <option value="all" {{ (!isset($status) || $status === 'all') ? 'selected' : '' }}>All Status</option>
                        <option value="active" {{ (isset($status) && $status === 'active') ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ (isset($status) && $status === 'inactive') ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
            @php
                $hasFilter = (request('role') && request('role') !== 'all')
                           || (request('status') && request('status') !== 'all')
                           || (request('search'));
            @endphp
            @if($hasFilter)
                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-secondary mt-3">Reset Filter</a>
            @endif
        </div>
    </div>

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
                    <th>Status</th>
                    <th>Actions</th>
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
                        <td>
                            @if($user->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.reset_password', $user) }}" onsubmit="return confirm('Reset password to 12345678 for this user?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Reset Password</button>
                                </form>
                            </div>
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
                    <p class="mb-2">
                        <strong>Status:</strong>
                        @if($user->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </p>
                    <div class="d-flex gap-2">
                        <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} w-100">
                                {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.reset_password', $user) }}" class="m-0" onsubmit="return confirm('Reset password to 12345678 for this user?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">Reset Password</button>
                        </form>
                    </div>
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

@push('scripts')
<script>
(function() {
    const searchInput = document.getElementById('search');
    const resultsBox = document.getElementById('liveUserResults');
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
            const status = document.getElementById('status')?.value || '';
            fetch(`{{ route('admin.users.live_search') }}?search=${encodeURIComponent(query)}&role=${encodeURIComponent(role)}&status=${encodeURIComponent(status)}`)
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
