@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Services Management</h3>
            @if(isset($statusFilter))
                @if($statusFilter === 'pending')
                    <span class="badge bg-secondary">Showing Pending Services (Entry & Running)</span>
                @elseif($statusFilter === 'finished')
                    <span class="badge bg-success">Showing Finished Services</span>
                @endif
            @endif
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Service
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Desktop Table View -->
    <div class="card d-none d-md-block">
        <div class="card-body">
            @if($services->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Phone</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Date</th>
                                <th>Job No</th>
                                <th>Reg No</th>
                                <th>Model</th>
                                <th>Amount (Tk)</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $loop->iteration + ($services->currentPage() - 1) * $services->perPage() }}</td>
                                    <td>{{ $service->phone }}</td>
                                    <td>{{ $service->name ?? '-' }}</td>
                                    <td>
                                        @if($service->role)
                                            <span class="badge bg-{{ $service->role === 'owner' ? 'primary' : 'success' }}">
                                                {{ ucfirst($service->role) }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $service->date ? $service->date->format('d M Y') : '-' }}</td>
                                    <td>{{ $service->job_no ?? '-' }}</td>
                                    <td>{{ $service->reg_no ?? '-' }}</td>
                                    <td>{{ $service->model ?? '-' }}</td>
                                    <td>{{ $service->tk_amount ? number_format($service->tk_amount, 2) : '-' }}</td>
                                    <td>
                                        <form action="{{ route('admin.services.update_status', $service) }}" method="POST" class="d-inline">
                                            @csrf
                                            <select name="status" class="form-select form-select-sm status-select"
                                                    onchange="this.form.submit()"
                                                    style="width: 110px;">
                                                <option value="entry" {{ $service->status === 'entry' ? 'selected' : '' }}>Entry</option>
                                                <option value="running" {{ $service->status === 'running' ? 'selected' : '' }}>Running</option>
                                                <option value="finished" {{ $service->status === 'finished' ? 'selected' : '' }}>Finished</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.services.edit', $service) }}"
                                               class="btn btn-outline-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger"
                                                    onclick="deleteService({{ $service->id }})" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-form-{{ $service->id }}"
                                              action="{{ route('admin.services.destroy', $service) }}"
                                              method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $services->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <p class="mt-3 text-muted">No services found. Click "Add New Service" to create one.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Cards View -->
    <div class="d-md-none">
        @if($services->count() > 0)
            @foreach($services as $service)
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="card-title">{{ $service->name ?? 'N/A' }}</h6>
                    <p class="mb-1"><strong>Phone:</strong> {{ $service->phone }}</p>
                    <p class="mb-1"><strong>Role:</strong>
                        @if($service->role)
                            <span class="badge bg-{{ $service->role === 'owner' ? 'primary' : 'success' }}">
                                {{ ucfirst($service->role) }}
                            </span>
                        @else
                            -
                        @endif
                    </p>
                    <p class="mb-1"><strong>Date:</strong> {{ $service->date ? $service->date->format('d M Y') : '-' }}</p>
                    <p class="mb-1"><strong>Job No:</strong> {{ $service->job_no ?? '-' }}</p>
                    <p class="mb-1"><strong>Reg No:</strong> {{ $service->reg_no ?? '-' }}</p>
                    <p class="mb-1"><strong>Model:</strong> {{ $service->model ?? '-' }}</p>
                    <p class="mb-1"><strong>Amount:</strong> {{ $service->tk_amount ? 'Tk ' . number_format($service->tk_amount, 2) : '-' }}</p>

                    <div class="mb-2">
                        <strong>Status:</strong>
                        <form action="{{ route('admin.services.update_status', $service) }}" method="POST" class="d-inline">
                            @csrf
                            <select name="status" class="form-select form-select-sm d-inline-block w-auto"
                                    onchange="this.form.submit()">
                                <option value="entry" {{ $service->status === 'entry' ? 'selected' : '' }}>Entry</option>
                                <option value="running" {{ $service->status === 'running' ? 'selected' : '' }}>Running</option>
                                <option value="finished" {{ $service->status === 'finished' ? 'selected' : '' }}>Finished</option>
                            </select>
                        </form>
                    </div>

                    <div class="mt-2">
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger"
                                onclick="deleteService({{ $service->id }})">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="mt-3">
                {{ $services->links() }}
            </div>
        @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <p class="mt-3 text-muted">No services found. Click "Add New Service" to create one.</p>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function deleteService(id) {
    if (confirm('Are you sure you want to delete this service?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush
@endsection
