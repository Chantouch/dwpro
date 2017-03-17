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
            return "<span class=\"label label-danger\">Disabled</span>";
        }
    }
}