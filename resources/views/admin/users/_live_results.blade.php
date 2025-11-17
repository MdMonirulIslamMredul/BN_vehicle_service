@if($users->count())
    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item d-flex align-items-center">
                <span class="me-2 fw-bold">{{ $user->name }}</span>
                <span class="me-2 text-muted">{{ $user->email }}</span>
                <span class="me-2 text-muted">{{ $user->phone }}</span>
                <span class="badge bg-{{ $user->role === 'owner' ? 'success' : ($user->role === 'driver' ? 'warning' : 'secondary') }} text-uppercase">{{ $user->role }}</span>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('admin.users', array_filter(['search' => request('search'), 'role' => request('role'), 'status' => request('status')])) }}" class="d-block text-center mt-2 small text-primary">See all results</a>
@else
    <div class="text-muted p-2">No users found.</div>
@endif
