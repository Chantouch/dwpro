<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $employees;

    /**
     * AdminController constructor.
     * @param Employee $employees
     */
    public function __construct(Employee $employees)
    {
        $this->middleware('auth:admin');
        $this->employees = $employees;
    }

    public function index()
    {
        return view('admin-home');
    }

    public function employees()
    {
        $title = "Employee management";
        return view('admin.employees.index', compact('title'));
    }

    public function show_employee($id)
    {
        $employee = $this->employees->with('verified_by')->find($id);
        return response()->json($employee);
    }
}