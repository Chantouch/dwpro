<?php

namespace App\Models;

use App\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    protected $table = "employees";
    use SoftDeletes;
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone_number', 'status', 'verified_by',
        'parent_id', 'position_id', 'department_id'
    ];

    public static function rules()
    {
        return [
            'first_name' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'first_name.required' => 'First name can not leave it blank',
        ];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
