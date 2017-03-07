<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Vinkla\Hashids\HashidsManager;

class AdminController extends Controller
{
    public $employees;
    protected $hashid;

    /**
     * AdminController constructor.
     * @param Employee $employees
     * @param HashidsManager $hashid
     */
    public function __construct(Employee $employees, HashidsManager $hashid)
    {
        $this->middleware('auth:admin');
        $this->employees = $employees;
        $this->hashid = $hashid;
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
        $title = "View employee";
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return back()->with('error', 'We can not find employee with that id, please try the other');
        }
        $employee = $this->employees->with([
            'verified_by', 'company_profile.industry',
            'company_profile.business_type',
            'company_profile.city', 'posts'
        ])->find($id);
        if (!$employee) {
            return back()->with('error', 'We can not find this employee, please other');
        }
        return view('admin.employees.profile', compact('employee', 'title'));
    }
}