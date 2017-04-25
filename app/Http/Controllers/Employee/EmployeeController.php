<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Models\BusinessType;
use App\Models\CompanyProfile;
use App\Models\Industry;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\HashidsManager;
use Validator;
use Illuminate\Support\Facades\DB;

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
        $update = $profile->update($request->all());
        if (!$update) {
            return response()->json(['error' => 'Can not update your profile now.']);
        }
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add_company_profile()
    {
        if ($this->guard()->user()->company_profile != null) {
            return redirect()->route('employee.home');
        } else {
            $no_employee = \Helper::no_employee();
            $industries = Industry::where('status', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
            $business_type = BusinessType::where('status', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
            return view('auth.employee.add-company-profile',
                compact('no_employee', 'industries', 'business_type'));
        }
    }


    public function post_add_company_profile(Request $request)
    {
        if ($this->guard()->user()->company_profile != null) {
            return redirect()->route('employee.home');
        } else {
            $messages = array(
                'name.required' => 'Please enter your company name',
                'city_id.required' => 'Please select city',
                'number_employee.required' => 'Please select number of employee',
                'industry_id.required' => 'Please select industry type of your company',
                'about_us.max' => 'About your company should not bigger than 255 length',
            );

            $rules = array(
                'name' => 'required|max:255',
                'city_id' => 'required|max:255',
                'number_employee' => 'required',
                'industry_id' => 'required',
                'about_us' => 'max:255',
                'website' => 'max:255',
            );

            DB::beginTransaction();
            try {
                $data = $request->all();
                //dd($data);
                $validator = Validator::make($data, CompanyProfile::rules(), CompanyProfile::messages());
                if ($validator->fails()) {
                    return redirect()->back()->withInput()->withErrors($validator);
                }
                $data['employee_id'] = $this->emp_id();
                $save = CompanyProfile::create($data);
                if (!$save) {
                    return response()->json(['error' => 'Can not update your profile now.']);
                }
                return redirect()->route('employee.home')->with('success', 'Your account is not yet activate.');
            } catch (\Exception $exception) {
                DB::rollback();
                return back()
                    ->withInput()
                    ->with('error', 'Error while registering in our website, Please contact to our Teach Support');
            }

        }
    }

    /**
     * @return mixed
     */
    public function guard()
    {
        return Auth::guard('employee');
    }
}
