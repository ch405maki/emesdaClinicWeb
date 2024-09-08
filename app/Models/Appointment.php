<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'dentist_id', 'appointment_date', 'status', 'last_dentist', 'occlusion', 'dent_anomaly', 'good_health', 'medical_treatment', 'surgical_operation', 'hospitalized', 'medication', 'tobacco', 'alcohol', 'allergy', 'pregnant', 'other',
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
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
        return self::with(['diagnostic', 'student', 'dentist'])->get();
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
