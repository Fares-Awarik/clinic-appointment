<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Appointment extends Model
{
    protected $fillable = [
    'patient_id',
    'doctor_id',
    'starts_at',
    'status',
];
public function patient(): BelongsTo
{
    return $this->belongsTo(Patient::class);
}

public function doctor(): BelongsTo
{
    return $this->belongsTo(Doctor::class);
}

}
