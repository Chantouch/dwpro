<?php

namespace App\Http\Controllers\Employee;

use App\Models\City;
use App\Models\ContractType;
use App\Models\Functions;
use App\Models\Industry;
use App\Models\Language;
use App\Models\Level;
use App\Models\Post;
use App\Models\Qualification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\HashidsManager;
use Validator;
use DB;
use Purifier;

class PostController extends Controller
{

    public $employee;
    protected $hashid;
    protected $post;

    /**
     * PostController constructor.
     * @param HashidsManager $hashid
     * @param Post $post
     */
    public function __construct(HashidsManager $hashid, Post $post)
    {
        $this->hashid = $hashid;
        $this->middleware('auth:employee');
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        $item = Post::latest()->paginate(1);
        //        $response = [
        //            'pagination' => [
        //                'total' => $item->total(),
        //                'per_page' => $item->perPage(),
        //                'current_page' => $item->currentPage(),
        //                'last_page' => $item->lastPage(),
        //                'from' => $item->firstItem(),
        //                'to' => $item->lastItem()
        //            ],
        //            'data' => $item,
        //        ];
        //        return response()->json($response);
        $title = "All Posts";
        $employee_id = Auth::guard('employee')->id();
        $posts = $this->post->where('employee_id', $employee_id)->with([
            'industry', 'city', 'qualification', 'level', 'contract_type',
            'functions', 'contact'
        ])->paginate(10);
        return view('employee.post.all', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create new post";
        $functions = Functions::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $contract = ContractType::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $cities = City::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $levels = Level::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $qualifications = Qualification::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $languages = Language::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $industries = Industry::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $year_experience = \Helper::year_experience();
        $marital_status = \Helper::marital_status();
        $gender = \Helper::gender();
        return view('employee.post.create', compact(
            'title', 'functions', 'contract', 'cities', 'levels', 'qualifications', 'year_experience',
            'languages', 'gender', 'marital_status', 'industries'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Post::rules(), Post::messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Some files has errors. Please correct it and then try it again.');
        }
        try {
            DB::beginTransaction();
            //Generate job id
//            $records = Post::withTrashed()->count();
//            $current_id = 1;
//            if (!$records == 0) {
//                $current_id = Post::withTrashed()->orderBy('id', 'DESC')->first()->id + 1;
//            }
            $data['emp_id'] = Auth::guard('employee')->user()->id;
//            $data['description'] = Purifier::clean($request->job_description);
//            $data['requirement_description'] = Purifier::clean($request->requirement_des);
//            $job_id = 'EMP_JOB' . str_pad($current_id, 6, '0', STR_PAD_LEFT);
//            $data['post_id'] = $job_id;
//            $data['closing_date'] = date('Y-m-d', strtotime($request->closing_date));
            $job = Post::create($data);
            dd($job);
            if ($job) {
                $job->languages()->attach($request->language_id);
            }

            if (!$job) {
                DB::rollbackTransaction();
                return redirect()->back()->withInput()->with('message', 'Unable to process your requires');
            }
        } catch (\Exception $exception) {

        }

        DB::commit();
        return redirect()->back()->with('message', 'New job has been Posted');
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
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $edit = Post::find($id)->update($request->all());
        return response()->json($edit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return response()->json('done');
    }

    public function status_active()
    {
        $title = "All Posts";
        $employee_id = Auth::guard('employee')->id();
        $posts = $this->post->where('employee_id', $employee_id)
            ->where('status', 1)
            ->with([
                'industry', 'city', 'qualification', 'level', 'contract_type',
                'functions', 'contact'
            ])->paginate(10);
        return view('employee.post.active', compact('posts', 'title'));
    }

    public function unpublished()
    {
        $title = "All Posts";
        $employee_id = Auth::guard('employee')->id();
        $posts = $this->post->where('employee_id', $employee_id)
            ->where('status', 0)
            ->with([
                'industry', 'city', 'qualification', 'level', 'contract_type',
                'functions', 'contact'
            ])->paginate(10);
        //dd($posts);
        return view('employee.post.un-published', compact('posts', 'title'));
    }

    public function status_expired()
    {
        $title = "All Posts";
        $employee_id = Auth::guard('employee')->id();
        $posts = $this->post->where('employee_id', $employee_id)
            ->where('status', 2)
            ->with([
                'industry', 'city', 'qualification', 'level', 'contract_type',
                'functions', 'contact'
            ])->paginate(10);
        return view('employee.post.expired', compact('posts', 'title'));
    }
}
