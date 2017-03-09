<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $jnv = Post::with([
            'employee', 'qualification', 'industry', 'level'
        ])->where('employee_id', $id)->where('status', 0);
        $ja = Post::with([
            'employee', 'qualification', 'industry', 'level'
        ])->where('employee_id', $id)->where('status', 1);
        $jfu = Post::with([
            'employee', 'qualification', 'industry', 'level'
        ])->where('employee_id', $id)->where('status', 2);

        $jobs_need_verify = $jnv->get();
        $jobs_need_verify_list = $jnv->paginate(20);
        $jobs_available = $ja->get();
        $jobs_available_list = $ja->paginate(20);
        $jobs_filled_up = $jfu->get();
        $jobs_filled_up_list = $jfu->paginate(20);

        if (!$employee) {
            return back()->with('error', 'We can not find this employee, please other');
        }
        return view('admin.employees.profile', compact(
            'employee', 'title', 'jobs_need_verify', 'jobs_need_verify_list',
            'jobs_available', 'jobs_available_list', 'jobs_filled_up', 'jobs_filled_up_list'
        ));
    }

    /**
     * To verified employee before they can post new job or do something els.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify_employee($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = $decoded[0];
        if (!$id) {
            return back()->with('error', 'We can not find this employee in our system, Please try other employee');
        }
        try {
            $employee = Employee::with('company_profile')->find($id);
            $employee->company_profile->enroll_no = str_replace('TEMP_', '', $employee->company_profile->temp_enroll_no);
            $employee->company_profile->temp_enroll_no = null;
            $employee->verified_by = Auth::guard('admin')->id();
            if ($employee->save() && $employee->company_profile->save()) {
                return back()->with('success', 'The Employee ' . $employee->company_profile->name . 'has been successfully approved');
            } else {
                return back()->with('error', 'The employee' . $employee->company_profile->name . 'hasn\'t been successfully approved');
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'The employer has not found!. 404');
        }
    }
}