<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 
        'dentist_id',
        'appointment_date', 
        'status'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist_id');
    }

    public function diagnostic()
    {
        return $this->hasOne(Diagnostic::class);
    }

    public function getFormattedDateAttribute()
    {
        return $this->appointment_date->format('F j, Y, g:i a');
    }

    public static function getAppointmentsWithDiagnostics()
    {
        return self::with(['diagnostic', 'patient', 'dentist'])->get();
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
