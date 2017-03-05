<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    protected $fillable = [
        'school_name', 'description', 'start_date', 'end_date', 'is_studying', 'country_id', 'city_id',
        'field_of_study', 'grad', 'level', 'user_id'
    ];
}
