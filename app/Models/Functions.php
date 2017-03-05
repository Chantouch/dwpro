<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Functions extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'status'
    ];

    public static function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Name can not leave it blank',
        ];
    }
}
