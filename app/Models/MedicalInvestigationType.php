<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalInvestigationType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function children(): HasMany
    {
        return $this->hasMany(MedicalInvestigationType::class, 'group_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(MedicalInvestigationType::class, 'group_id');
    }

    public function scopeParentInvestigationType(Builder $query): Builder
    {
        return $query->where('group_id', null);
    }
}
