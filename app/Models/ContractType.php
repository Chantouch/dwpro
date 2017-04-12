<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class ContractType extends Model
{
    use SoftDeletes;
    use Sluggable;
    protected $fillable = [
        'name', 'description', 'status', 'slug'
    ];

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
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
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
