<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Patient extends Model
{
    protected $fillable = [
        'full_name',
        'national_id_number',
        'age',
        'email',
        'gender',
        'phone',
        'address',
    ];
    public function appointments(): HasMany
{
    return $this->hasMany(Appointment::class);
}
}
