<?php

/**
 * User: Chantouch
 * Date: 17/03/2017
 * Time: 11:13 AM
 */
use Carbon\Carbon;

class Helper
{

    public static function year_experience()
    {
        return [
            '0' => 'Less Than 2 Years',
            '1' => '2-5 Years',
            '2' => '5-7 Years',
            '3' => 'More Than 7 Years'
        ];
    }

    public static function gender()
    {
        return [
            '0' => 'Both',
            '1' => 'Female',
            '2' => 'Male',
        ];
    }


    public static function marital_status()
    {
        return [
            '0' => 'Both',
            '1' => 'Married',
            '2' => 'Single',
        ];
    }

    public static function relationship($model)
    {
        if ($model == null) {
            return "N/A";
        } else {
            return $model->name;
        }
    }

    public static function salary()
    {
        return [
            '0' => 'Unspecified',
            '1' => '0 - 199 USD',
            '2' => '200 - 499 USD',
            '3' => '500 - 999 USD',
            '4' => '1,000 - 1,999 USD',
            '5' => '2,000 USD+',
        ];
    }


    //-------Show at the front end of user-----------------//

    public static function status($status)
    {
        if ($status == 0) {
            return "<span class=\"label label-success\">Disabled</span>";
        } elseif ($status == 1) {
            return "<span class=\"label label-success\">Active</span>";
        } elseif ($status == 2) {
            return "<span class=\"label label-info\">Filled Up</span>";
        } elseif ($status == 3) {
            return "<span class=\"label label-primary\">Draft</span>";
        } else {
            return "<span class=\"label label-danger\">Unpublished</span>";
        }
        //return $status;
    }

    public static function show_salary($convert)
    {
        if ($convert == 0) {
            return "Unspecified";
        }
        if ($convert == 1) {
            return "0 - 199 USD";
        }
        if ($convert == 2) {
            return "200 - 499 USD";
        }
        if ($convert == 3) {
            return "500 - 999 USD";
        }
        if ($convert == 4) {
            return "1,000 - 1,999 USD";
        }
        if ($convert == 5) {
            return "2,000 USD+";
        } else {
            return "Others";
        }
        //return $convert;

    }

    public static function show_marital($status)
    {
        if ($status == 0) {
            return "Both";
        }
        if ($status == 1) {
            return "Married";
        }
        if ($status == 2) {
            return "Single";
        } else {
            return "Others";
        }
    }

    public static function show_year_exp($year)
    {
        if ($year == 0) {
            return "Less Than 2 Years";
        }
        if ($year == 1) {
            return "2 - 5 Years";
        }
        if ($year == 2) {
            return "5 - 7 Years";
        }
        if ($year == 3) {
            return "More Than 7 Years";
        } else {
            return "Others";
        }
    }

    public static function show_gender($gender)
    {
        if ($gender == 0) {
            return "Both";
        }
        if ($gender == 1) {
            return "Female";
        }
        if ($gender == 2) {
            return "Male";
        } else {
            return "Others";
        }
    }

    public static function date_time_format($date)
    {
        return Carbon::parse($date)->format('D-d-M-Y H:i A');
    }
}