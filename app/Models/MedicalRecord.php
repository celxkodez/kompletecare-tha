<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function investigationTypes(): BelongsToMany
    {
        return $this->belongsToMany(MedicalInvestigationType::class, 'medical_investigations', 'medical_record_id', 'investigation_type');
    }

    public function investigations(): HasMany
    {
        return $this->hasMany(MedicalInvestigation::class);
    }
}
