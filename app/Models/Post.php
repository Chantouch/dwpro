<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = [
        'name', 'description', 'status', 'hire_number', 'industry_id', 'function_id',
        'city_id', 'salary', 'job_description', 'level_id', 'contract_type_id', 'year_experience',
        'qualification_id', 'field_of_study', 'gender', 'age_from', 'age_to', 'marital_status',
        'requirement_des', 'contact_id', 'employee_id', 'status', 'closing_date', 'published_date'
    ];


}
