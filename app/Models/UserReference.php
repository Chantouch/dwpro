<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class UserReference extends Model
{

    protected $appends = "hashid";
    protected $fillable = [
        'first_name', 'last_name', 'company_name', 'position', 'phone_number', 'email', 'user_id'
    ];

    /**
     * @return mixed
     */
    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }

    public static function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'company_name' => 'required',
            'position' => 'required',
            'phone_number' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'company_name.required' => 'Company / Establishment / Experience is required',
        ];
    }
}
