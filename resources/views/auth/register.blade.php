@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h3 class="text-center mb-4">Create Account</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Register As</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Select Role --</option>
                            <option value="owner">Vehicle Owner</option>
                            <option value="driver">Driver</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" id="extraField"></div>
                </div>

                <button type="submit" class="btn btn-success w-100">Register</button>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelector('[name="role"]').addEventListener('change', function() {
    const extraField = document.getElementById('extraField');
    if (this.value === 'owner') {
        extraField.innerHTML = `
            <label class="form-label">Vehicle Chassis Number/ license_number</label>
            <input type="text" name="license_number" class="form-control" required>
        `;
    } else if (this.value === 'driver') {
        extraField.innerHTML = `
            <label class="form-label">Driver License Number</label>
            <input type="text" name="license_number" class="form-control" required>
        `;
    } else {
        extraField.innerHTML = '';
    }
});
</script>
@endsection
