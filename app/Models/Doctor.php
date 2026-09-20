<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Doctor extends Model
{
   protected $fillable = [
    
        'name',
        'speciality',
        'phone',
        'is_active'
   ];
   public function appointments(): HasMany
{
    return $this->hasMany(Appointment::class);
}
}