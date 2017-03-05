<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReference extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'company_name', 'position', 'phone_number', 'email', 'user_id'
    ];
}
