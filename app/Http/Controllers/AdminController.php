<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        return view('/admin/dashboard');
    }

    public function users()
    {
       // $users = User::all();
         // Get all non-admin users

        $users = \App\Models\User::where('role', '!=', 'admin')
        ->orderBy('created_at', 'desc')
        ->paginate(10);;
        return view('admin.users.index', compact('users'));
    }

    // Show all vehicles
    public function vehicles()
    {
        $vehicles = Vehicle::with('user')
        ->latest()
        ->paginate(10);;
        return view('admin.vehicles.index', compact('vehicles'));
    }




    // Show all appointments
   public function appointments( Request $request)
    {
        // Fetch all appointments as Eloquent models (casts will work)
        // $appointments = Appointment::orderBy('date', 'desc')->get();
        // $appointments = Appointment::orderByRaw("CASE WHEN status = 'not_connected' THEN 0 ELSE 1 END")
        // ->orderBy('date', 'desc')
        // ->get();

        $filter = $request->get('status');

         $appointments = Appointment::when($filter && $filter !== 'all', function ($query) use ($filter) {
            $query->where('status', $filter);
        })
        ->orderByRaw("CASE WHEN status = 'not_connected' THEN 0 ELSE 1 END")
        ->orderBy('date')
        ->paginate(10); // Paginate with 10 items per page


        return view('admin.appointments.index', compact('appointments', 'filter'));
    }


    public function updateAppointmentStatus($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->status = $appointment->status === 'connected' ? 'not_connected' : 'connected';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }



}
