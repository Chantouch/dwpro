<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class UserAttachment extends Model
{
    protected $appends = "hashid";
    protected $fillable = [
        'user_id', 'name', 'path', 'file'
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
            'name' => 'required',
            'file' => 'required',
        ];
    }

    public static function messages()
    {
        return [

        ];
    }
}
