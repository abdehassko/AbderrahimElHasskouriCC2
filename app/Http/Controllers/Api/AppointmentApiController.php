<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentApiController extends Controller
{
    public function index()
    {
        return response()->json(
            Appointment::with(['patient', 'doctor', 'service'])->get()
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'status' => 'required'
        ]);

        $appointment = Appointment::create($request->all());

        return response()->json([
            'message' => 'Appointment created successfully',
            'data' => $appointment
        ], 201);
    }
    //
}