<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class TargetJob extends Model
{
    protected $appends = "hashid";
    protected $fillable = [
        'status', 'user_id', 'contract_type_id', 'desired_salary', 'industry_id', 'city_id'
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
            'status' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'status.required' => 'Select your current employment status'
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract_type()
    {
        return $this->belongsTo(ContractType::class);
    }

}
