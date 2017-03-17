<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    public function index()
    {
        $title = "Employee Dashboard";
        return view('employee.dashboard', compact('title'));
    }
}
