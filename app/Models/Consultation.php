<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consultation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function medicalRecords(): HasMany
    {
        return $this->hasMany(MedicalRecord::class, 'consultation_id');
    }
}
