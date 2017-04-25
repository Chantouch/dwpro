<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Mail\ApplyJob;
use App\Models\Apply;
use App\Models\City;
use App\Models\CompanyProfile;
use App\Models\ContractType;
use App\Models\Functions;
use App\Models\Industry;
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
        $posts = $this->post->where('status', 1)->take(4)->get();
        $companies = Employee::where('status', 1)->where('parent_id', 0)->get();
        $contract_terms = ContractType::where('status', 1)->get();
        $feature_posts = $this->post->all();
        $cities = City::where('status', 1)->orderBy('created_at', 'ASC')->pluck('name', 'id');
        $full_time_posts = Post::where('status', 1)->get();
        $filed_up_posts = Post::where('status', 2)->get();
        $applications = User::where('status', 1)->get();
        return view('front.index', compact(
            'posts', 'feature_posts', 'companies',
            'contract_terms', 'full_time_posts', 'filed_up_posts',
            'applications', 'cities'
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
     * @internal param $post_id
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
            $post_id = $job->id;
            $data['post_id'] = $post_id;
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
                'post_id' => $post_id,
            ]));
            Mail::to('chantouchsek.cs83@gmail.com')->send($email);
        } catch (\Exception $exception) {

        }
        DB::commit();
        return redirect()->back()->withInput()->with('message', "You are successfully applied to {$job->name}");

    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_by_function($slug)
    {
        $cat = Functions::where('slug', $slug)->firstOrFail();
        $all_posts = $this->post->where('status', 1)->take(4)->get();
        $current_date = date('Y-m-d');
        $contract_terms = ContractType::where('status', 1)->get();
        $posts = Post::with(['industry', 'employee'])->where('functions_id', $cat->id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
        //return response()->json($functions);
        return view('front.jobs.searchby', compact('posts', 'contract_terms', 'all_posts'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_by_industry($slug)
    {
        $city_list = City::with('posts')->where('status', 1)->pluck('name', 'id');
        $industry = Industry::with('posts')->where('slug', $slug)->firstOrFail();
        $current_date = date('Y-m-d');
        $contract_terms = ContractType::where('status', 1)->get();
        $posts = Post::with('industry', 'employer')->where('industry_id', '=', $industry->id)->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('created_at', 'DESC')->paginate(20);
        return view('front.jobs.searchby', compact('posts', 'contract_terms'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_by_company($slug)
    {
        $cities = City::with('posts')->where('status', 1)->pluck('name', 'id');
        $company = CompanyProfile::with('employee.posts')->where('slug', $slug)->firstOrFail();
        $current_date = date('Y-m-d');
        $contract_terms = ContractType::where('status', 1)->get();
        $posts = Post::with('industry', 'employee')->where('employee_id', $this->guard()->id())->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('front.jobs.searchby', compact('posts', 'contract_terms','cities'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_by_city($slug)
    {
        $all_posts = $this->post->where('status', 1)->take(4)->get();
        $city = City::with('posts')->where('slug', $slug)->firstOrFail();
        $current_date = date('Y-m-d');
        $contract_terms = ContractType::where('status', 1)->get();
        $posts = Post::with('industry', 'employee')->where('city_id', '=', $city->id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('front.jobs.searchby', compact('posts', 'contract_terms', 'all_posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_functions()
    {
        $functions = Functions::with('posts')->get();
        return view('front.search.all', compact('functions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_industries()
    {
        $industries = Industry::all();
        return view('front.search.all', compact('industries'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_companies()
    {
        $companies = CompanyProfile::all();
        return view('front.search.all', compact('companies'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_cities()
    {
        $cities = City::all();
        return view('front.search.all', compact('cities'));
    }

    /**
     * @return mixed
     */
    public function guard()
    {
        return auth()->guard('employee');
    }
}
