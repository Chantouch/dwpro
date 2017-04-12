<?php

namespace App\Http\Controllers\Employee;

use App\Models\City;
use App\Models\Contact;
use App\Models\ContractType;
use App\Models\Functions;
use App\Models\Industry;
use App\Models\Language;
use App\Models\Level;
use App\Models\Post;
use App\Models\Qualification;
use Carbon\Carbon;
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
        $posts = $this->post->where('employee_id', $this->emp_id())->with([
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
        $langs = Language::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $industries = Industry::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $year_experience = \Helper::year_experience();
        $marital_status = \Helper::marital_status();
        $salary = \Helper::salary();
        $gender = \Helper::gender();
        $closing_date = Carbon::now()->addMonth(1);
        $contact = Contact::where('status', 1)->where('parent_id', $this->emp_id())->pluck('first_name', 'id');
        return view('employee.post.create', compact(
            'title', 'functions', 'contract', 'cities', 'levels', 'qualifications', 'year_experience',
            'langs', 'gender', 'marital_status', 'industries', 'salary', 'closing_date', 'contact'
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
        DB::beginTransaction();
        //Generate job id
        $records = Post::count();
        $current_id = 1;
        if (!$records == 0) {
            $current_id = Post::orderBy('id', 'DESC')->first()->id + 1;
        }
        $data['employee_id'] = $this->emp_id();
        $job_id = 'EMP_JOB' . str_pad($current_id, 6, '0', STR_PAD_LEFT);
        $data['post_id'] = $job_id;
        $data['closing_date'] = date('Y-m-d', strtotime($request->closing_date));
        $data['contact_id'] = Auth::guard('employee')->user()->id;
        switch ($request->submitbutton) {
            case "save":
                $data['status'] = 1;
                break;
            case "save-draft":
                $data['status'] = 3;
                break;
            default:
                $data['status'] = 0;
                break;
        }
        $data['closing_date'] = Carbon::now()->addMonth(1);
        $job = Post::create($data);
        if ($job) {
            $job->languages()->attach($request->language_id);
        }
        if (!$job) {
            DB::rollbackTransaction();
            return redirect()->back()->withInput()->with('message', 'Unable to process your requires');
        }

        DB::commit();
        return redirect()->route('employee.posts.edit', [$job->hashid])->with('success', 'You\'r reviewing your recently published job.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return redirect()->back()->with('error', 'We can not find this job.');
        }
        $job = Post::with([
            'industry', 'city', 'qualification', 'level', 'contract_type',
            'functions', 'contact', 'languages'
        ])->find($id);
        return view('employee.post.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param null $draft
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $draft = null)
    {

        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return redirect()->back()->with('error', 'We can not find this job.');
        }
        switch ($draft) {
            case "edit-draft":
                $job = Post::where('employee_id', $this->emp_id())->where('status', 3)->find($id);
                if (!$job) {
                    return back()->with('error', 'You can not update this job');
                }
                break;
            case "edit-active":
                $job = Post::where('employee_id', $this->emp_id())->where('status', 1)->find($id);
                if (!$job) {
                    return back()->with('error', 'You can not update this job');
                }
                break;
            default:
                $job = Post::where('employee_id', $this->emp_id())->where('status', 1)->find($id);
                if (!$job) {
                    return back()->with('error', 'You can not update this job');
                }
                break;
        }
        $functions = Functions::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $contract = ContractType::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $cities = City::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $levels = Level::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $qualifications = Qualification::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $languages = Language::all();
        $langs = array();
        foreach ($languages as $language) {
            $langs[$language->id] = $language->name;
        }
        $industries = Industry::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $year_experience = \Helper::year_experience();
        $marital_status = \Helper::marital_status();
        $salary = \Helper::salary();
        $gender = \Helper::gender();
        $contact = Contact::where('status', 1)->where('parent_id', $this->emp_id())->pluck('first_name', 'id');
        return view('employee.post.edit', compact('job', 'functions', 'contract', 'cities', 'levels', 'qualifications', 'year_experience',
            'langs', 'gender', 'marital_status', 'industries', 'salary', 'contact'
        ));
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
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return redirect()->back()->with('error', 'We can not find this job.');
        }
        $data = $request->all();
        $validator = Validator::make($data, Post::rules(), Post::messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Some files has errors. Please correct it and then try it again.');
        }
        $edit = Post::where('employee_id', $this->emp_id())->find($id);
        switch ($request->submitbutton) {
            case "save":
                $data['status'] = 1;
                break;
            case "save-draft":
                $data['status'] = 3;
                break;
            default:
                $data['status'] = 4;
                break;
        }
        $edit->update($data);
        if ($edit) {
            if (isset($request->language_id)) {
                $edit->languages()->sync($request->language_id);
            } else {
                $edit->languages()->sync(array());
            }
        }
        return redirect()->route('employee.posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return redirect()->back()->with('error', 'We can not find this job.');
        }
        Post::find($id)->delete();
        return redirect()->back()->with('success', 'Post deleted successfully');
    }

    public function status_active()
    {
        $title = "All Posts";
        $posts = $this->post->where('employee_id', $this->emp_id())
            ->where('status', 1)
            ->with([
                'industry', 'city', 'qualification', 'level', 'contract_type',
                'functions', 'contact'
            ])->paginate(10);
        return view('employee.post.active', compact('posts', 'title'));
    }

    public function status_drafts()
    {
        $title = "All Posts";
        $posts = $this->post->where('employee_id', $this->emp_id())
            ->where('status', 3)
            ->with([
                'industry', 'city', 'qualification', 'level', 'contract_type',
                'functions', 'contact'
            ])->paginate(10);
        return view('employee.post.drafts', compact('posts', 'title'));
    }

    public function unpublished()
    {
        $title = "All Posts";
        $posts = $this->post->where('employee_id', $this->emp_id())
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
        $posts = $this->post->where('employee_id', $this->emp_id())
            ->where('status', 2)
            ->with([
                'industry', 'city', 'qualification', 'level', 'contract_type',
                'functions', 'contact'
            ])->paginate(10);
        return view('employee.post.expired', compact('posts', 'title'));
    }

    public function emp_id()
    {
        return Auth::guard('employee')->id();
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_job_status($id, Request $request)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if (!$id) {
            return redirect()->back()->with('error', 'We can not find this jobs id, Please contact try it later.');
        }
        $status = 1;
        $route_name = $request->route()->getName();
        if ($route_name == 'employee.update_job.status_filled_up') {
            $status = 2;
        } elseif ($route_name == 'employee.update_job.status_active') {
            $status = 1;
        } elseif ($route_name == 'employee.update_job.status_disabled') {
            $status = 0;
        }
        $model = Post::findOrFail($id);
        $model->status = $status;

        if ($model->save())
            return redirect()->back()->with('success', 'Job status has been updated');
        else
            return redirect()->back()->with('error', 'Unable to process please try again');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param $draft
     * @return \Illuminate\Http\Response
     */
    public function edit_draft($id, $draft = "")
    {

        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return redirect()->back()->with('error', 'We can not find this job.');
        }
        switch ($draft) {
            case "edit-draft":
                $job = Post::where('employee_id', $this->emp_id())->where('status', 3)->find($id);
                if (!$job) {
                    return back()->with('error', 'You can not update this job. Status 3');
                }
                break;
            case "edit-active":
                $job = Post::where('employee_id', $this->emp_id())->where('status', 1)->find($id);
                if (!$job) {
                    return back()->with('error', 'You can not update this job. Status 1.');
                }
                break;
            default:
                $job = Post::where('employee_id', $this->emp_id())->where('status', 1)->find($id);
                if (!$job) {
                    return back()->with('error', 'You can not update this job. Status default.');
                }
                break;
        }
        $functions = Functions::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $contract = ContractType::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $cities = City::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $levels = Level::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $qualifications = Qualification::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $languages = Language::all();
        $langs = array();
        foreach ($languages as $language) {
            $langs[$language->id] = $language->name;
        }
        $industries = Industry::where('status', 1)->orderBy('id', 'asc')->pluck('name', 'id');
        $year_experience = \Helper::year_experience();
        $marital_status = \Helper::marital_status();
        $salary = \Helper::salary();
        $gender = \Helper::gender();
        $contact = Contact::where('status', 1)->where('employee_id', $this->emp_id())->pluck('name', 'id');
        return view('employee.post.edit', compact('job', 'functions', 'contract', 'cities', 'levels', 'qualifications', 'year_experience',
            'langs', 'gender', 'marital_status', 'industries', 'salary', 'contact'
        ));
    }
}
