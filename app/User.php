<?php

namespace App;

use App\Models\UserProfile;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Vinkla\Hashids\Facades\Hashids;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;

    protected $appends = ['hashid'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'phone_number', 'verified_by', 'status', 'date_of_birth',
        'enroll_id', 'enroll_temp', 'avatar', 'avatar_path', 'terms', 'confirm_code', 'verified_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function rule()
    {
        return [
            'username' => 'required'
        ];
    }

    //SetAndGet Attribute

    /**
     * @return mixed
     */
    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function verified_by()
    {
        return $this->belongsTo(Admin::class, 'verified_by');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['seo_url'],
            ]
        ];
    }

    /**
     * @return string
     */
    public function getSeoUrlAttribute()
    {
        return $this->username;
    }

    public function getVerificationStatusAttribute()
    {
        $name = "";
        if ($this->verified_by === null) {
            return "Need Verified";
        } else {
            try {
                $verified = User::find($this->verified_by);
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
        $this->verified_status = 'verified';
        $this->status = 1;
        $this->confirm_code = null;
        $this->save();
    }
}
