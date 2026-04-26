<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentConfirmed;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor', 'service'])->get();

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'status' => 'required|string',
        ]);
        $appointment = Appointment::create($request->all());

        Mail::to(auth()->user()->email)->send(new AppointmentConfirmed($appointment));

        return redirect()->back()->with('success', 'Appointment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {

        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $appointment->update($request->all());

        return redirect('/appointments')->with('success', 'Appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment updated successfully');
    }

    public function search(Request $request)
    {
        $q = $request->q;

        $appointments = Appointment::with(['patient', 'doctor', 'service'])
            ->where(function ($query) use ($q) {
                $query->where('appointment_date', 'like', "%$q%")
                    ->orWhere('status', 'like', "%$q%")
                    ->orWhereHas('patient', function ($q2) use ($q) {
                        $q2->where('first_name', 'like', "%$q%")
                            ->orWhere('last_name', 'like', "%$q%");
                    })
                    ->orWhereHas('doctor', function ($q2) use ($q) {
                        $q2->where('first_name', 'like', "%$q%")
                            ->orWhere('last_name', 'like', "%$q%");
                    })
                    ->orWhereHas('service', function ($q2) use ($q) {
                        $q2->where('name', 'like', "%$q%");
                    });
            })
            ->get();

        return response()->json($appointments);
    }
}