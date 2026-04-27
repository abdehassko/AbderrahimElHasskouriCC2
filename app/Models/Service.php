<?php

namespace App\Models;

use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    /** @use HasFactory<ServiceFactory> */
    use HasFactory;
    public const   CATEGORIES = [
        'consultation' => 'Consultation',
        'diagnostics' => 'Diagnostics',
        'laboratory' => 'Laboratory',
        'imaging' => 'Imaging',
        'surgery' => 'Surgery',
        'therapy' => 'Therapy',
        'emergency' => 'Emergency',
        'pharmacy' => 'Pharmacy',
        'home_care' => 'Home Care',
        'other' => 'Other',
    ];

    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}