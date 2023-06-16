<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalInvestigation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function record(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(MedicalInvestigationType::class, 'investigation_type');
    }
}
