<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
   protected $fillable = [
    
        'name',
        'speciality',
        'phone',
        'is_active'
   ];
}