<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class UserLanguage extends Model
{

    protected $appends = "hashid";
    protected $fillable = [
        'user_id', 'language_id', 'level'
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
            'language_id' => 'required',
            'level' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'language_id.required' => 'Please choose a language',
            'level.required' => 'Please choose a level of what you can',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
