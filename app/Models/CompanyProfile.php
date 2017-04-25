<?php

namespace App\Models;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'name', 'employee_id', 'industry_id', 'business_type_id', 'city_id', 'website',
        'address', 'company_email', 'about_us', 'number_employee', 'slug', 'tag_line',
        'longitude', 'latitude', 'confirm_code', 'temp_enroll_no', 'enroll_no', 'photo_path',
        'how_we_work', 'currently_hiring', 'looking_for', 'logo_photo', 'cover_photo',
        'phone_number'
    ];

    //===============Validation===============//
    public static function rules()
    {
        return [
            'name' => 'required|unique:company_profiles|max:255',
            'city_id' => 'required|max:255',
            'number_employee' => 'required',
            'industry_id' => 'required',
            'about_us' => 'max:255',
            'website' => 'max:255',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Please enter your company name',
            'city_id.required' => 'Please select city',
            'number_employee.required' => 'Please select number of employee',
            'industry_id.required' => 'Please select industry type of your company',
            'about_us.max' => 'About your company should not bigger than 255 length',
        ];
    }

    //===============Relationship===========//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function business_type()
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }


    //=========GetAndSetAttributes========//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imagable');
    }
}
