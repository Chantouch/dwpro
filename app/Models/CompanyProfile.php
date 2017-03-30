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
