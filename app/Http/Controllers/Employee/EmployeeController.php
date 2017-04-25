<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Models\BusinessType;
use App\Models\CompanyProfile;
use App\Models\Industry;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Vinkla\Hashids\HashidsManager;
use Validator;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

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
            DB::beginTransaction();
            try {
                $data = $request->all();
                //dd($data);
                $validator = Validator::make($data, CompanyProfile::rules(), CompanyProfile::messages());
                if ($validator->fails()) {
                    return redirect()->back()->withInput()->withErrors($validator);
                }
                $id = $this->emp_id();
                $path = 'uploads/employers/profile/';
                $small = $path . '/small/' . $id . '/';
                $medium = $path . '/medium/' . $id . '/';
                $avatar = $path . '/avatar/' . $id . '/';
                $destination_path = public_path($medium);
                $destination_small = public_path($small);
                $destination_avatar = public_path($avatar);
                if ($request->hasFile('logo_photo')) {
                    if ($request->file('logo_photo')->isValid()) {
                        if (!file_exists($destination_path)) {
                            mkdir($destination_path, 0777, true);
                        }
                        if (!file_exists($destination_avatar)) {
                            mkdir($destination_avatar, 0777, true);
                        }
                        if (!file_exists($destination_small)) {
                            mkdir($destination_small, 0777, true);
                        }
                        $avatar = Image::make($request->file('logo_photo'))->resize(787, 787);
                        $profile_image = Image::make($request->file('logo_photo'))->resize(800, 385);
                        $profile_small = Image::make($request->file('logo_photo'))->resize(200, 40);
                        //to remove space from string
                        $company_name = preg_replace('/\s+/', '_', strtolower($request->name));
                        $fileName = uniqid($company_name . '_') . '_' . time() . '.' . $request->file('logo_photo')->getClientOriginalExtension();
                        $avatar->save($destination_avatar . '/' . $fileName, 100);
                        $profile_image->save($destination_path . '/' . $fileName, 100);
                        $profile_small->save($destination_small . '/' . $fileName, 100);
                        $data['photo_path'] = $path;
                        $data['cover_path'] = $path;
                        $data['logo_photo'] = $fileName;
                    }
                }
                $data['employee_id'] = $this->emp_id();
                $save = CompanyProfile::create($data);
                if (!$save) {
                    return response()->json(['error' => 'Can not update your profile now.']);
                }
                return redirect()->route('employee.home')->with('success', 'Your account is not yet activate.');
            } catch (Exception $exception) {
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
