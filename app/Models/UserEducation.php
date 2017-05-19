<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class UserEducation extends Model
{
    protected $appends = "hashid";
    protected $fillable = [
        'school_name', 'description', 'start_date', 'end_date', 'is_studying', 'country_id', 'city_id',
        'field_of_study', 'grade', 'level', 'user_id'
    ];

    public static function rules()
    {
        return [
            'school_name' => 'required',
            'start_date' => 'required',
            'level' => 'required'
        ];
    }

    public static function messages()
    {
        return [

        ];
    }

    /**
     * @return mixed
     */
    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
