<?php

/**
 * User: Chantouch
 * Date: 17/03/2017
 * Time: 11:13 AM
 */
use Carbon\Carbon;

class Helper
{

    /**
     * @return array
     */
    public static function year_experience()
    {
        return [
            '0' => 'Less Than 2 Years',
            '1' => '2-5 Years',
            '2' => '5-7 Years',
            '3' => 'More Than 7 Years'
        ];
    }

    /**
     * @return array
     */
    public static function gender()
    {
        return [
            '0' => 'Both',
            '1' => 'Female',
            '2' => 'Male'
        ];
    }

    /**
     * @return array
     */
    public static function language_level()
    {
        return [
            '' => 'Select the level of proficiency you have in this language',
            '0' => 'Basic Knowledge',
            '1' => 'Conversational',
            '2' => 'Full working proficiency',
        ];
    }

    /**
     * @return array
     */
    public static function marital_status()
    {
        return [
            '0' => 'Both',
            '1' => 'Married',
            '2' => 'Single',
        ];
    }


    /**
     * @return array
     */
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

    /**
     * @return array
     */
    public static function no_employee()
    {
        return [
            '' => 'Select the company size (No. of employees)',
            '0' => '1 - 5',
            '1' => '6 - 10',
            '2' => '11 - 20',
            '3' => '12 - 50',
            '4' => '51 - 100',
            '5' => '101 - 500',
            '6' => '501 - 1000',
            '7' => '1001 - 5000',
            '8' => 'More than 5000',
        ];
    }

    /**
     * @return array
     */
    public static function candidate_status()
    {
        return [
            '0' => 'Select',
            '1' => 'Active Searching'
        ];
    }

    public static function skill_level()
    {
        return [
            '' => 'Select the level of proficiency',
            '1' => 'Beginner',
            '2' => 'Intermediate',
            '3' => 'Professional',
        ];
    }

    public static function skill_year()
    {
        return [
            '' => 'Select the years of experience in this skill',
            '1' => '1 year or less',
            '2' => '2-5 years',
            '3' => '5-7 years',
            '4' => 'More than 7 years',
        ];
    }


    //-------Show at the front end of user-----------------//

    /**
     * @param $status
     * @return string
     */
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

    /**
     * @param $convert
     * @return string
     */
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

    /**
     * @param $status
     * @return string
     */
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

    /**
     * @param $year
     * @return string
     */
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

    /**
     * @param $gender
     * @return string
     */
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

    /**
     * @param $date
     * @return string
     */
    public static function date_time_format($date)
    {
        return Carbon::parse($date)->format('D-d-M-Y H:i A');
    }

    /**
     * @param $parent
     * @return null
     */
    public static function check_null($parent)
    {
        if ($parent == null || $parent == '') {
            return null;
        }
        return $parent;
    }

    /**
     * @param $model
     * @return string
     */
    public static function relationship($model)
    {
        if ($model == null) {
            return "Not Selected";
        } else {
            return $model->name;
        }
    }

    /**
     * @param $level
     * @return array|string
     */
    public static function language_level_show($level)
    {
        if ($level === 0)
            return 'Basic Knowledge';
        if ($level === 1)
            return 'Conversational';
        if ($level === 2)
            return 'Full working proficiency';
        return "None for all ";
    }
}