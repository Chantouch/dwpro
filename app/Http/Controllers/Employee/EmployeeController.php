<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Models\CompanyProfile;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\HashidsManager;
use Validator;

class EmployeeController extends Controller
{

    public $employee;
    protected $hashid;
    protected $post;

    public function __construct(HashidsManager $hashid, Post $post)
    {
        $this->hashid = $hashid;
        $this->middleware('auth:employee');
        $this->post = $post;
    }

    public function credential_rule(array $data)
    {
        $message = [
            'current_password.required' => 'Please enter your current password',
            'password.required' => 'Please enter your new password'
        ];

        $validator = Validator::make($data, [
            'current_password' => 'required',
            'password' => 'required|same:password|min:6',
            'confirm_new_password' => 'required|same:password|min:6',
        ]);

        return $validator;
    }

    public function index()
    {
        $title = "Employee Dashboard";
        return view('employee.dashboard', compact('title'));
    }

    public function all_posts()
    {
        $title = "All Posts";
        $employee_id = Auth::guard('employee')->id();
        $posts = $this->post->where('employee_id', $employee_id)->with([
            'industry', 'city', 'qualification', 'level', 'contract_type',
            'functions', 'contact'
        ])->paginate(10);
        return view('employee.post.all', compact('posts', 'title'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function posts()
    {
        $employee_id = Auth::guard('employee')->id();
        $posts = $this->post->where('employee_id', $employee_id)->with([
            'industry', 'city', 'qualification', 'level', 'contract_type',
            'functions', 'contact', 'languages'
        ])->paginate(10);
        return response()->json($posts);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function company_profile()
    {
        $profile = CompanyProfile::with([
            'employee', 'city', 'business_type', 'industry'
        ])->where('employee_id', $this->emp_id())->first();
        //return response()->json($profile);
        return view('employee.company-profile', compact('profile'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit_profile()
    {
        $profile = CompanyProfile::with([
            'employee', 'city', 'business_type', 'industry'
        ])->where('employee_id', $this->emp_id())->first();
        return response()->json($profile);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_profile(Request $request)
    {
        $profile = CompanyProfile::with([
            'employee', 'city', 'business_type', 'industry'
        ])->where('employee_id', $this->emp_id())->first();
        $profile->update($request->all());
        return response()->json(['message' => 'Your profile updated successfully.']);
    }

    /**
     * @return mixed
     * @get user id
     */
    public function emp_id()
    {
        return Auth::guard('employee')->id();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact_form()
    {
        return view('employee.contact.index');
    }

    public function get_contact_deleted()
    {
        return view('employee.contact.deleted');
    }


    public function show_change_password()
    {
        return view('employee.account-setting.change-password');
    }

    public function change_password(Request $request)
    {
        $auth = Auth::guard('employee')->user();
        if ($auth) {
            $data = $request->all();
            $validator = $this->credential_rule($data);;
            if ($validator->fails()) {
                $this->throwValidationException($request, $validator);
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $current_password = $auth->password;
                if (Hash::check($data['current_password'], $current_password)) {
                    $id = $auth->id;
                    $employee = Employee::find($id);
                    $employee->password = bcrypt($data['password']);
                    $employee->save();

                    return redirect()->back()->with('success', 'Your password changed successfully');
                } else {
                    return redirect()->back()->with('error', 'Please enter your right current password and try again.')->withInput();
                }
            }
        } else {
            return redirect()->intended('employee/login')->with('message', 'Please login first to change your password');
        }
    }
}
