@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Add New Service</h3>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.services.store') }}">
                @csrf

                <div class="row">
                    <!-- Phone Number with Search -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}" required>
                            <button type="button" class="btn btn-primary" id="searchPhone">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Name (Auto-filled) -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address (Auto-filled) -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role (Auto-filled) -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">User Role</label>
                        <input type="text" name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                            value="{{ old('role') }}" readonly>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Vehicle Selection (shown when multiple vehicles exist) -->
                    <div class="col-md-12 mb-3" id="vehicleSelectContainer" style="display: none;">
                        <label class="form-label">Select Vehicle <span class="text-danger">*</span></label>
                        <select id="vehicleSelect" class="form-select">
                            <option value="">-- Choose a vehicle --</option>
                        </select>
                        <small class="text-muted">This user has multiple vehicles. Please select one to auto-fill vehicle details.</small>
                    </div>

                    <!-- Registration No -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Registration No</label>
                        <input type="text" name="reg_no" id="reg_no" class="form-control @error('reg_no') is-invalid @enderror"
                            value="{{ old('reg_no') }}">
                        @error('reg_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Chassis No -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Chassis No</label>
                        <input type="text" name="chassis_no" id="chassis_no" class="form-control @error('chassis_no') is-invalid @enderror"
                            value="{{ old('chassis_no') }}">
                        @error('chassis_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Model -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Model</label>
                        <input type="text" name="model" id="model" class="form-control @error('model') is-invalid @enderror"
                            value="{{ old('model') }}">
                        @error('model')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                            value="{{ old('date') }}">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Entry Time -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Entry Time</label>
                        <input type="time" name="entry_time" class="form-control @error('entry_time') is-invalid @enderror"
                            value="{{ old('entry_time') }}">
                        @error('entry_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Job No -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Job No</label>
                        <input type="text" name="job_no" class="form-control @error('job_no') is-invalid @enderror"
                            value="{{ old('job_no') }}">
                        @error('job_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Driver Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Driver Name</label>
                        <input type="text" name="drv_name" class="form-control @error('drv_name') is-invalid @enderror"
                            value="{{ old('drv_name') }}">
                        @error('drv_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tk Amount</label>
                        <input type="number" step="0.01" name="tk_amount" class="form-control @error('tk_amount') is-invalid @enderror"
                            value="{{ old('tk_amount') }}">
                        @error('tk_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="entry" {{ old('status', 'entry') === 'entry' ? 'selected' : '' }}>Entry</option>
                            <option value="running" {{ old('status') === 'running' ? 'selected' : '' }}>Running</option>
                            <option value="finished" {{ old('status') === 'finished' ? 'selected' : '' }}>Finished</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Job Description -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Job Description</label>
                        <textarea name="job_description" rows="4" class="form-control @error('job_description') is-invalid @enderror">{{ old('job_description') }}</textarea>
                        @error('job_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">Save Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
let userVehicles = [];

document.getElementById('searchPhone').addEventListener('click', function() {
    const phone = document.getElementById('phone').value;

    if (!phone) {
        alert('Please enter a phone number');
        return;
    }

    // Show loading state
    this.disabled = true;
    this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Searching...';

    fetch(`{{ route('admin.services.search_phone') }}?phone=${encodeURIComponent(phone)}`)
        .then(response => response.json())
        .then(data => {
            if (data.found) {
                // Fill user information
                document.getElementById('name').value = data.data.name || '';
                document.getElementById('address').value = data.data.address || '';
                document.getElementById('role').value = data.data.role || '';

                // Store vehicles data
                userVehicles = data.vehicles || [];

                // Handle vehicle selection based on number of vehicles
                if (userVehicles.length === 0) {
                    // No vehicles - clear fields
                    clearVehicleFields();
                    hideVehicleSelector();
                    alert('User found but has no registered vehicles');
                } else if (userVehicles.length === 1) {
                    // Single vehicle - auto-fill directly
                    fillVehicleFields(userVehicles[0]);
                    hideVehicleSelector();
                } else {
                    // Multiple vehicles - show selector
                    showVehicleSelector();
                    clearVehicleFields();
                }
            } else {
                // Clear all fields if user not found
                document.getElementById('name').value = '';
                document.getElementById('address').value = '';
                document.getElementById('role').value = '';
                clearVehicleFields();
                hideVehicleSelector();
                userVehicles = [];
                alert('User not found with this phone number');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error searching for user');
        })
        .finally(() => {
            this.disabled = false;
            this.innerHTML = '<i class="bi bi-search"></i> Search';
        });
});

// Handle vehicle selection from dropdown
document.getElementById('vehicleSelect').addEventListener('change', function() {
    const selectedVehicleId = parseInt(this.value);

    if (!selectedVehicleId) {
        clearVehicleFields();
        return;
    }

    const vehicle = userVehicles.find(v => v.id === selectedVehicleId);
    if (vehicle) {
        fillVehicleFields(vehicle);
    }
});

function showVehicleSelector() {
    const container = document.getElementById('vehicleSelectContainer');
    const select = document.getElementById('vehicleSelect');

    // Clear existing options
    select.innerHTML = '<option value="">-- Choose a vehicle --</option>';

    // Add vehicle options
    userVehicles.forEach(vehicle => {
        const option = document.createElement('option');
        option.value = vehicle.id;
        option.textContent = `${vehicle.registration_number} - ${vehicle.make} ${vehicle.model} (${vehicle.year})`;
        select.appendChild(option);
    });

    container.style.display = 'block';
}

function hideVehicleSelector() {
    document.getElementById('vehicleSelectContainer').style.display = 'none';
    document.getElementById('vehicleSelect').innerHTML = '<option value="">-- Choose a vehicle --</option>';
}

function fillVehicleFields(vehicle) {
    document.getElementById('reg_no').value = vehicle.registration_number || '';
    document.getElementById('chassis_no').value = vehicle.chassis_number || '';
    document.getElementById('model').value = vehicle.model || '';
}

function clearVehicleFields() {
    document.getElementById('reg_no').value = '';
    document.getElementById('chassis_no').value = '';
    document.getElementById('model').value = '';
}

// Also search on Enter key in phone field
document.getElementById('phone').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        document.getElementById('searchPhone').click();
    }
});
</script>
@endpush
@endsection
