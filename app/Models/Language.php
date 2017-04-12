<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'status'
    ];

    public static function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Name can not leave it blank',
        ];
    }

    //==============Relationship=============//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
