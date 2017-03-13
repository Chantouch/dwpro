<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Models\CompanyProfile;
use App\Models\Post;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Vinkla\Hashids\HashidsManager;

class AdminController extends Controller
{
    private $employees;
    private $post;
    protected $hashid;
    private $candidate;

    /**
     * BusinessTypeController constructor.
     * @param Employee $employees
     * @param HashidsManager $hashid
     * @param Post $post
     * @param User $candidate
     */
    public function __construct(Employee $employees, HashidsManager $hashid, Post $post, User $candidate)
    {
        $this->employees = $employees;
        $this->hashid = $hashid;
        $this->post = $post;
        $this->candidate = $candidate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employees->with([
            'verified_by', 'company_profile.industry',
            'company_profile.business_type',
            'company_profile.city', 'posts'
        ])->paginate(50);
        return response()->json($employees);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function employee_jobs($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return back()->with('error', 'We can not find employee with that id, please try the other');
        }
        $all_jobs = $this->post->with([
            'employee', 'industry', 'qualification', 'level'
        ])->where('employee_id', $id)->paginate(10);
        return response()->json($all_jobs);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function get_jobs_available($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return back()->with('error', 'We can not find employee with that id, please try the other');
        }
        $jobs_need_verify = $this->post->with([
            'employee', 'industry', 'qualification', 'level'
        ])->where('employee_id', $id)->where('status', 1)->get();
        return response()->json($jobs_need_verify);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function get_need_verify_job($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return back()->with('error', 'We can not find employee with that id, please try the other');
        }
        $jobs_need_verify = $this->post->with([
            'employee', 'industry', 'qualification', 'level'
        ])->where('employee_id', $id)->where('status', 0)->get();
        return response()->json($jobs_need_verify);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function get_job_filled_up($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return back()->with('error', 'We can not find employee with that id, please try the other');
        }
        $get_job_filled_up = $this->post->with([
            'employee', 'industry', 'qualification', 'level'
        ])->where('employee_id', $id)->where('status', 2)->get();
        return response()->json($get_job_filled_up);
    }


    ///========CountJob===========///
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function count_all_jobs($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return back()->with('error', 'We can not find employee with that id, please try the other');
        }
        $count_all_jobs = $this->post->with([
            'employee', 'industry', 'qualification', 'level'
        ])->where('employee_id', $id)->count();
        return response()->json([
            'data' => $count_all_jobs
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function count_need_verify_job($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return back()->with('error', 'We can not find employee with that id, please try the other');
        }
        $jobs_need_verify = $this->post->with([
            'employee', 'industry', 'qualification', 'level'
        ])->where('employee_id', $id)->where('status', 0)->count();
        return response()->json([
            'data' => $jobs_need_verify
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function count_jobs_available($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return back()->with('error', 'We can not find employee with that id, please try the other');
        }
        $jobs_need_verify = $this->post->with([
            'employee', 'industry', 'qualification', 'level'
        ])->where('employee_id', $id)->where('status', 1)->paginate(500)->total();
        return response()->json([
            'data' => $jobs_need_verify
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function count_jobs_filled_up($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return back()->with('error', 'We can not find employee with that id, please try the other');
        }
        $count_jobs_filled_up = $this->post->with([
            'employee', 'industry', 'qualification', 'level'
        ])->where('employee_id', $id)->where('status', 2)->paginate(500)->total();
        return response()->json([
            'data' => $count_jobs_filled_up
        ]);
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
                return response()->json(['done']);
            } else {
                return response()->json([
                    'message' => 'We can not process your request right now.',
                ], 404);
            }
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'We can not process your request right now.',
            ], 404);
        }
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update_job_status(Request $request, $id)
    {
        $data = $request->all();
        Post::with('employee')->find($id)->update($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_un_verify_employee()
    {
        $verify_employee = $this->employees->with([
            'verified_by', 'company_profile.industry',
            'company_profile.business_type',
            'company_profile.city', 'posts'
        ])->where('verified_by', null)->paginate(25);
        return response()->json($verify_employee);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_un_active_employee()
    {
        $un_active_employee = $this->employees->with([
            'verified_by', 'company_profile.industry',
            'company_profile.business_type',
            'company_profile.city', 'posts'
        ])->where('status', 0)->paginate(25);
        return response()->json($un_active_employee);
    }

    ///Candidate Section
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_candidate_list()
    {
        $candidates = $this->candidate->with([
            'verified_by'
        ])->paginate(10);
        return response()->json($candidates);
    }


    public function get_un_active_candidate()
    {
        $un_active = User::with(['verified_by'])->where('status', 0)->paginate(10);
        return response()->json($un_active);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        Post::with('employee')->find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
