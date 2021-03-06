<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class UserSkill extends Model
{

    protected $appends = "hashid";
    protected $fillable = [
        'name', 'level', 'year_exp', 'user_id'
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
            'year_exp' => 'required',
            'name' => 'required',
            'level' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'year_exp.required' => 'Years of Experience is required',
        ];
    }

}
