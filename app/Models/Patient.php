<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
