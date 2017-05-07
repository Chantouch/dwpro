<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'cover_letter', 'about_me', 'address',
        'date_of_birth', 'country_id', 'city_id'
    ];


    public static function rule()
    {
        return [
            'about_me' => 'required|min:2|max:255'
        ];
    }


    public static function message()
    {
        return [
            'about_me.required' => 'Please field your profile.',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function candidate()
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
}
