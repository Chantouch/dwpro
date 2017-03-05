<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin-home');
    }

    public function getBusinessType()
    {
        return view('administrator.modules.business-type.index');
    }

    public function getCityProvince()
    {
        return view('administrator.modules.city-province.index');
    }

    public function getDepartment()
    {
        return view('administrator.modules.department.index');
    }

    public function getFunction()
    {
        return view('administrator.modules.function.index');
    }

    public function getIndustry()
    {
        return view('administrator.modules.industry.index');
    }

    public function getQualification()
    {
        return view('administrator.modules.qualification.index');
    }

    public function getLevel()
    {
        return view('administrator.modules.level.index');
    }

    public function getLanguage()
    {
        return view('administrator.modules.language.index');
    }

    public function getPosition()
    {
        return view('administrator.modules.position.index');
    }
}