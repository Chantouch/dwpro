<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetJob extends Model
{
    protected $fillable = [
        'status', 'user_id', 'contract_type_id', 'desire_salary', 'industry_id', 'city_id'
    ];

}
