<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Mail\ApplyJob;
use App\Models\Apply;
use App\Models\ContractType;
use App\Models\Post;
use App\User;
use Validator;
use DB;
use Purifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Vinkla\Hashids\HashidsManager;

class HomeController extends Controller
{

    public $post;
    protected $hashid;

    /**
     * Create a new controller instance.
     *
     * @param Post $post
     * @param HashidsManager $hashid
     */
    public function __construct(Post $post, HashidsManager $hashid)
    {
        $this->middleware('web');
        $this->post = $post;
        $this->hashid = $hashid;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->take(4)->get();
        $companies = Employee::where('status', 1)->get();
        $contract_terms = ContractType::where('status', 1)->get();
        $feature_posts = $this->post->all();
        $full_time_posts = Post::where('status', 1)->get();
        return view('front.index', compact(
            'posts', 'feature_posts', 'companies',
            'contract_terms', 'full_time_posts'
        ));
    }

    public function getPost()
    {

        return view('employee.post.index');
    }

    public function view_post($id, $company, $industry, $slug)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return redirect()->back()->with('error', 'We can not find this job.');
        }
        $post = $this->post->with(['industry', 'employee.company_profile'])->where('slug', $slug)->first();
        $related_jobs = $this->post->with(['industry', 'employee.company_profile'])->get();
        $posts = $this->post->take(4)->get();
        $contract_terms = ContractType::where('status', 1)->get();
        $full_time_posts = Post::where('status', 1)->get();
        return view('front.jobs.view', compact('post', 'related_jobs', 'posts', 'contract_terms', 'full_time_posts'));
    }

    //For candidate apply job directly from site

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $job_id
     */
    public function apply_job($id, Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, Apply::rule(), Apply::message());
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please fix errors, and try once again');
        }
        DB::beginTransaction();
        $job = Post::find($id);
        try {
            $path = 'uploads/applies/attachment/' . date('Y/m/d/h-i');
            $destination_path = public_path($path);
            if ($request->hasFile('attachment')) {
                if ($request->file('attachment')) {
                    if (!file_exists($destination_path)) {
                        mkdir($destination_path, 0777, true);
                    }
                    $fileName = preg_replace('/\s+/', '', $request->name) . '_' . 'attachment.' . $request->file('attachment')->getClientOriginalExtension();
                    $request->file('attachment')->move($destination_path, $fileName);
                    $data['attachment'] = $path . '/' . $fileName;

                }
            }
            $job_id = $job->id;
            $data['job_id'] = $job_id;
            $data['message'] = Purifier::clean($request->message);
            $apply = Apply::create($data);
            if (!$apply) {
                DB::rollbackTransaction();
                return redirect()->back()->withInput()->with('error', 'Error in you transaction');
            }
            $email = new ApplyJob(new Apply([
                'name' => $request->name,
                'phone' => $request->phone,
                'attachment' => $request->attachment,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'post_id' => $job,
            ]));
            Mail::to('chantouchsek.cs83@gmail.com')->send($email);
        } catch (\Exception $exception) {

        }
        DB::commit();
        return redirect()->back()->withInput()->with('message', "You are successfully applied to {$job->name}");

    }
}
