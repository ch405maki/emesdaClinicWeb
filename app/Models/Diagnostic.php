<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_id',
        'occlusion',
        'condition',
        'hygiene',
        'denture_upper',
        'denture_lower',
        'since_upper',
        'since_lower',
        'abnormalities',
        'general_condition',
        'physician',
        'nature_treatment',
        'alergies',
        'history',
        'ailments',
        'bp',
        'drugs',
        'description',
        'service_rendered',
        'remarks',
        'dental_chart'
    ];

    /**
     * Relationship: Diagnostic belongs to an appointment.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Relationship: Diagnostic belongs to a user as a student.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Relationship: Diagnostic belongs to a user as a dentist.
     */
    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist_id');
    }
}
