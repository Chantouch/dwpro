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
        'first_name', 'last_name', 'email', 'password', 'phone_number', 'status', 'verified_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


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
}
