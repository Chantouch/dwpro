<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    protected $fillable = [
        'job_title', 'description', 'company_name', 'start_date', 'end_date', 'is_working',
        'country_id', 'city_id', 'contract_id', 'industry_id', 'role', 'level_id', 'user_id'
    ];


}
