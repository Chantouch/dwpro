<?php

namespace App;

use App\Models\CompanyProfile;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Vinkla\Hashids\Facades\Hashids;
use App\Notifications\EmployeeResetPassword as ResetPasswordNotification;

class Employee extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $appends = ['hashid'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone_number', 'status',
        'verified_by', 'confirm_code', 'avatar', 'temp_enroll_no', 'avatar_path', 'department_id',
        'position_id', 'slug', 'role', 'enrol_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //==============Send Notification===========//

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    //==============Validation============//

    /**
     * @return array
     */
    public static function rules()
    {
        return [
            'first_name.required' => 'Please enter first name',
            'last_name.required' => 'Please enter last name',
            'phone_number.required' => 'Please enter mobile phone',
            'email.required' => 'Please enter email',
            'email.unique' => 'This email is already taken. Please input a another email',
            'password.required' => 'Please enter password',
            'terms.required' => 'Please accept to our term and condition',
        ];
    }

    /**
     * @return array
     */
    public static function messages()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required',
            'email' => 'required|email|max:255|unique:employees',
            'password' => 'required|min:6|confirmed',
            'terms' => 'required',
        ];
    }


    //==============Relationship=============//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function verified_by()
    {
        return $this->belongsTo(Admin::class, 'verified_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company_profile()
    {
        return $this->hasOne(CompanyProfile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'parent_id');
    }

    ///============Get and Set Attribute=============////

    /**
     * @return mixed
     */
    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }

    public function getVerificationStatusAttribute()
    {
        $name = "";
        if ($this->verified_by === null) {
            return "Need Verified";
        } else {
            try {
                $verified = Admin::find($this->verified_by);
                $name = $verified->name;
            } catch (ModelNotFoundException $exception) {

            }
            return $name;
        }
    }

    //Verified employee after register

    /**
     * verified employer
     */
    public function verified()
    {
        $this->status = 1;
        $this->confirm_code = null;
        $this->save();
    }
}
