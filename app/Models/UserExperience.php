<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\In;
use Vinkla\Hashids\Facades\Hashids;

class UserExperience extends Model
{
    protected $appends = "hashid";
    protected $fillable = [
        'job_title', 'description', 'company_name', 'start_date', 'end_date', 'is_working',
        'country_id', 'city_id', 'contract_type_id', 'industry_id', 'role', 'level_id', 'user_id', 'functions_id'
    ];

    public static function rules()
    {
        return [
            'job_title' => 'required',
            'company_name' => 'required',
            'start_date' => 'required',
            'city_id' => 'required',
            'contract_type_id' => 'required',
            'industry_id' => 'required',
            'function_id' => 'required'
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
    public function user()
    {
        return $this->belongsTo(User::class);
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
    public function functions()
    {
        return $this->belongsTo(Functions::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract_type()
    {
        return $this->belongsTo(ContractType::class);
    }
}
