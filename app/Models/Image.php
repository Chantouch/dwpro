<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'original_name', 'original_size', 'new_name', 'new_size', 'path', 'imagable_id', 'imagable_type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     * Get all of the owning imagable models.
     */
    public function imagable()
    {
        return $this->morphTo();
    }
}
