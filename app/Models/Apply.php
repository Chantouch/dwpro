<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'name',
        'email', 'phone', 'subject',
        'message', 'attachment'
    ];

    /**
     * @return array
     */
    public static function rule()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'subject' => 'required|max:100',
            'message' => 'required|max:700',
            'attachment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024000',
        ];
    }

    public static function message()
    {
        return [
            'name.required' => 'required',
            'email.required' => 'required',
            'phone.required' => 'required',
            'subject.required' => 'required',
            'message.required' => 'required|max:700',
            'attachment.required' => 'required|mimes:pdf,doc,docx|image|mimes:jpeg,png,jpg,gif,svg|max:1024000',
        ];
    }

    /**
     * @var array
     */
    protected $guarded = [
        'id',
        '_token',
        '_method'
    ];

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = ($value == '+855') ? '' : $value;
    }
}
