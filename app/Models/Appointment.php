<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;

    protected $fillable = [
        'appointment_date',
        'status',
    ];

    public function patient() :BelongsTo{
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function doctor() :BelongsTo{
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function service() :BelongsTo{
        return $this->belongsTo(Service::class);
    }
}