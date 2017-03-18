<?php

/**
 * User: Chantouch
 * Date: 17/03/2017
 * Time: 11:13 AM
 */
class Helper
{
    public static function status($status)
    {
        if ($status == 1) {
            return "<span class=\"label label-success\">Active</span>";
        } else {
            return "<span class=\"label label-danger\">Unpublished</span>";
        }
    }

    public static function year_experience()
    {
        return [
            '' => 'Choose the required minimum year of experiences',
            'less_than_two' => 'Less Than 2 Years',
            'two_to_five' => '2-5 Years',
            'five_to_seven' => '5-7 Years',
            'more_than_seven' => 'More Than 7 Years'
        ];
    }

    public static function gender()
    {
        return [
            '' => 'Choose the required gender',
            'male' => 'Male',
            'female' => 'Female',
            'both' => 'Both'
        ];
    }

    public static function marital_status()
    {
        return [
            '' => '---Choose desired---',
            'single' => 'Single',
            'married' => 'Married',
            'both' => 'Both'
        ];
    }
}