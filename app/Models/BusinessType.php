<?php

namespace App\Models;

use App\Helpers\DataViewer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessType extends Model
{
    use SoftDeletes;
    use DataViewer;
    protected $fillable = [
        'name', 'description', 'status'
    ];

    public static $columns = [
        'id', 'name', 'description', 'status'
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
}
