<?php

namespace App\Models;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable = [
        'name', 'description', 'status', 'hire_number', 'industry_id', 'function_id',
        'city_id', 'salary', 'job_description', 'level_id', 'contract_type_id', 'year_experience',
        'qualification_id', 'field_of_study', 'gender', 'age_from', 'age_to', 'marital_status',
        'requirement_des', 'contact_id', 'employee_id', 'status', 'closing_date', 'published_date'
    ];


    //----------Validation-------------//

    public static function rules()
    {
        return [
            'name' => 'required|min:3',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Please fill name!',
        ];
    }


    //===========Relationship==========//
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
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
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
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
    public function contract_type()
    {
        return $this->belongsTo(ContractType::class);
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
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
