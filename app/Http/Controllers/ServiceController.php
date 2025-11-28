<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(Request $request)
    {
        $statusFilter = $request->get('status');

        $services = Service::query()
            ->when($statusFilter === 'pending', function ($query) {
                $query->whereIn('status', ['entry', 'running']);
            })
            ->when($statusFilter === 'finished', function ($query) {
                $query->where('status', 'finished');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends(['status' => $statusFilter]);

        return view('admin.services.index', compact('services', 'statusFilter'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:30',
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'reg_no' => 'nullable|string|max:255',
            'chassis_no' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'entry_time' => 'nullable',
            'job_no' => 'nullable|string|max:255',
            'job_description' => 'nullable|string',
            'drv_name' => 'nullable|string|max:255',
            'tk_amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:entry,running,finished',
        ]);

        // Default status to 'entry' if not provided
        $validated['status'] = $validated['status'] ?? 'entry';

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:30',
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'reg_no' => 'nullable|string|max:255',
            'chassis_no' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'entry_time' => 'nullable',
            'job_no' => 'nullable|string|max:255',
            'job_description' => 'nullable|string',
            'drv_name' => 'nullable|string|max:255',
            'tk_amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:entry,running,finished',
        ]);

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Search user by phone number and return their details along with vehicle info.
     */
    public function searchByPhone(Request $request)
    {
        $phone = $request->get('phone');

        if (!$phone) {
            return response()->json([
                'found' => false,
                'data' => null,
                'vehicles' => []
            ]);
        }

        $user = User::where('phone', $phone)->first();

        if ($user) {
            // Get all vehicles for this user
            $vehicles = Vehicle::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($vehicle) {
                    return [
                        'id' => $vehicle->id,
                        'registration_number' => $vehicle->registration_number,
                        'chassis_number' => $vehicle->chassis_number,
                        'model' => $vehicle->model,
                        'make' => $vehicle->make,
                        'year' => $vehicle->year,
                    ];
                });

            return response()->json([
                'found' => true,
                'data' => [
                    'name' => $user->name,
                    'address' => $user->address,
                    'role' => $user->role,
                ],
                'vehicles' => $vehicles
            ]);
        }

        return response()->json([
            'found' => false,
            'data' => null
        ]);
    }    /**
     * Update service status.
     */
    public function updateStatus(Request $request, Service $service)
    {
        $validated = $request->validate([
            'status' => 'required|in:entry,running,finished',
        ]);

        $service->update(['status' => $validated['status']]);

        return redirect()->back()
            ->with('success', 'Service status updated successfully.');
    }

    /**
     * Show user's services by phone (for authenticated users).
     */
    public function myServices()
    {
        $user = auth()->user();
        $services = Service::where('phone', $user->phone)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('services.my-services', compact('services'));
    }
}
