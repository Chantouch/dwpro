<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    protected $fillable = [
        'name', 'level', 'year_exp', 'user_id'
    ];
}
