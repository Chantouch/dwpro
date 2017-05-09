<?php

namespace App\Models;

use App\Employee;
use Cviebrock\EloquentSluggable\Sluggable;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //use SoftDeletes;
    use Sluggable;
    protected $appends = ['hashid'];
    public $fillable = [
        'name', 'status', 'hire_number', 'industry_id', 'functions_id', 'post_id',
        'city_id', 'salary', 'job_description', 'level_id', 'contract_type_id', 'year_experience',
        'qualification_id', 'field_of_study', 'gender', 'age_from', 'age_to', 'marital_status',
        'requirement_des', 'contact_id', 'employee_id', 'closing_date', 'published_date'
    ];


    //----------Validation-------------//

    public static function rules()
    {
        return [
            'name' => 'required|min:3',
            'job_description' => 'required|min:10',
            'functions_id' => 'required',
            'contract_type_id' => 'required',
            'city_id' => 'required',
            'hire_number' => 'required|min:1|integer',
            'age_from' => 'numeric|smaller_than:age_to',
            'age_to' => 'numeric|greater_than:age_from',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Job title is required',
            'job_description.required' => 'Job description is required',
            'functions_id.required' => 'Job function is required',
            'contract_type_id.required' => 'Type of employment is required',
            'city_id.required' => 'City is required',
            'hire_number.required' => 'Please input number of employment.',
            'hire_number.integer' => 'Number of employment number must be an integer or number',
            'age_to.greater_than' => 'Age max can not be small than age min',
            'age_from.smaller_than' => 'Age min can not be greater than age max',
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

    //----------PivotTable-----------//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'posts_languages', 'post_id', 'language_id')->withPivot('post_id', 'language_id')->withTimestamps();
    }


    //----------Sluggable---------//

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'seo_url'
            ]
        ];
    }


    //-------GetAttributes--------//

    /**
     * @return string
     */
    public function getSeoUrlAttribute()
    {
        return $this->name . '-' . $this->industry->name . $this->functions->name . ' in ' . $this->city->name;
    }

    /**
     * @return mixed
     */
    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }


    //----Scope----//
    public function scopeWithCandidateName($query, $name)
    {
        return $query->whereHas(['contract_type_id' => function ($q) use ($name) {
            $q->where('contract_type_id', $name);
        }]);
    }
}
