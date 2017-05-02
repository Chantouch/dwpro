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
use Session;

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
     * @return mixed
     */
    public function guard()
    {
        return auth()->guard('employee');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->where('status', 1)->take(20)->get();
        $companies = Employee::where('status', 1)->where('parent_id', 0)->get();
        $contract_terms = ContractType::where('status', 1)->get();
        $feature_posts = $this->post->where('status', 1)->get();
        $cities = City::where('status', 1)->orderBy('created_at', 'ASC')->pluck('name', 'id');
        $full_time_posts = Post::where('status', 1)->get();
        $filed_up_posts = Post::where('status', 2)->get();
        $applications = User::where('status', 1)->get();
        $feature_cities = City::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $feature_functions = Functions::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $feature_industries = Industry::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $feature_companies = Employee::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();

        return view('front.index', compact(
            'posts', 'feature_posts', 'companies',
            'contract_terms', 'full_time_posts', 'filed_up_posts',
            'applications', 'cities', 'feature_cities', 'feature_companies',
            'feature_functions', 'feature_industries'
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
        $feature_functions = Functions::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $feature_industries = Industry::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $feature_companies = Employee::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $feature_cities = City::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $post = $this->post->with(['industry', 'employee.company_profile'])->where('slug', $slug)->first();
        $name = explode(' ', trim($post->name));
        $related_jobs = $this->post
            ->with(['industry', 'employee.company_profile'])
            ->where('name', 'like', '%' . $name[0] . '%')
            ->get();
        $contract_types = ContractType::where('status', 1)->get();
        $full_time_posts = Post::where('status', 1)->get();
        return view('front.jobs.view',
            compact(
                'post', 'related_jobs', 'contract_types', 'full_time_posts',
                'feature_functions', 'feature_industries', 'feature_companies', 'feature_cities'
            )
        );
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
        $title = "Job by functions";
        $cat = Functions::where('slug', $slug)->firstOrFail();
        $all_posts = $this->post->where('status', 1)->take(4)->get();
        $current_date = date('Y-m-d');
        $cities = City::with('posts')->where('status', 1)->pluck('name', 'id');
        $contract_terms = ContractType::where('status', 1)->get();
        $posts = Post::with(['industry', 'employee'])->where('functions_id', $cat->id)->where('status', 1)->orderBy('created_at', 'DESC')->get();
        //return response()->json($functions);
        return view('front.jobs.searchby', compact('posts', 'contract_terms', 'all_posts', 'title', 'cities'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_by_industry($slug)
    {
        $title = "Job by industry";
        $cities = City::with('posts')->where('status', 1)->pluck('name', 'id');
        $industry = Industry::with('posts')->where('slug', $slug)->firstOrFail();
        $current_date = date('Y-m-d');
        $contract_terms = ContractType::where('status', 1)->get();
        $posts = Post::with('industry', 'employee')->where('industry_id', $industry->id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('front.jobs.searchby', compact('posts', 'contract_terms', 'title', 'cities'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_by_company($slug)
    {
        $title = "Job by company";
        $cities = City::with('posts')->where('status', 1)->pluck('name', 'id');
        $company = CompanyProfile::with('employee.posts')->where('slug', $slug)->firstOrFail();
        $current_date = date('Y-m-d');
        $contract_terms = ContractType::where('status', 1)->get();
        $posts = Post::with('industry', 'employee')->where('employee_id', $company->employee->id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('front.jobs.searchby', compact('posts', 'contract_terms', 'cities', 'title'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_by_city($slug)
    {
        $title = "Job in city";
        $all_posts = $this->post->where('status', 1)->take(4)->get();
        $city = City::with('posts')->where('slug', $slug)->firstOrFail();
        $cities = City::with('posts')->where('status', 1)->pluck('name', 'id');
        $current_date = date('Y-m-d');
        $top_opening_jobs = Post::with('employee')->where('status', 1)->take(6)->get();
        $contract_terms = ContractType::where('status', 1)->get();
        $posts = Post::with('industry', 'employee')->where('city_id', $city->id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('front.jobs.searchby',
            compact('posts', 'contract_terms', 'all_posts', 'title', 'cities', 'top_opening_jobs')
        );
    }


    public function search_by_contract_term($slug)
    {
        $title = "Job by contract term";
        $term = ContractType::with('posts')->where('slug', $slug)->firstOrFail();
        $cities = City::with('posts')->where('status', 1)->pluck('name', 'id');
        $current_date = date('Y-m-d');
        $contract_terms = ContractType::where('status', 1)->get();
        $posts = Post::with('industry', 'employee')->where('contract_type_id', $term->id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('front.jobs.searchby', compact('posts', 'contract_terms', 'title', 'cities'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_functions()
    {
        $title = "Job in functions";
        $functions = Functions::with('posts')->get();
        return view('front.search.all', compact('functions', 'title'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_industries()
    {
        $title = "Job in industries";
        $industries = Industry::all();
        return view('front.search.all', compact('industries', 'title'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_companies()
    {
        $title = "Job in companies";
        $companies = CompanyProfile::all();
        return view('front.search.all', compact('companies', 'title'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_cities()
    {
        $title = "Job in cities";
        $cities = City::all();
        return view('front.search.all', compact('cities', 'title'));
    }

    public function job_Search(Request $request)
    {
        $current_date = date('Y-m-d');
        $category = Functions::with('posts')->where('status', 1)->limit(5)->get();
        $industry = Industry::with('posts')->where('status', 1)->orderBy('name', 'ASC')->take(5)->get();
        $company = Employee::with('posts')->where('status', 1)->limit(5)->get();
        $feature_functions = Functions::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $feature_industries = Industry::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $feature_companies = Employee::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $feature_cities = City::where('status', 1)->orderBy('created_at', 'ASC')->take(5)->get();
        $top_jobs = Post::with('industry', 'employee')->where('status', 1)->where('closing_date', '>=', $current_date)->orderBy('salary', 'DESC')->take(5)->get();
        $cities = City::with('posts')->where('status', 1)->pluck('name', 'id');
        $query = Post::query();
        $city = $request->input('city');
        $post_name = $request->input('name');
        $salary_min = $request->input('salary');
        $experiences = $request->input('experiences');
        $feature_posts = $this->post->all();
        if ($city) {
            $query->where(function ($q) use ($city) {
                $q->where('name', 'like', "%$city%")
                    ->orWhere('city_id', 'like', "%$city%");
            });
        }
        if ($post_name) {
            $query->where(function ($q) use ($post_name) {
                $q->where('name', 'like', "%$post_name%")
                    ->orWhere('city_id', 'like', "%$post_name%");
            });
        }
        if ($salary_min) {
            $query->where(function ($q) use ($salary_min) {
                $q->where('name', 'like', "%$salary_min%")
                    ->orWhere('salary', 'like', "%$salary_min%");
            });
        }
        if ($experiences) {
            $query->where(function ($q) use ($experiences) {
                $q->where('name', 'like', "%$experiences%")
                    ->orWhere('year_experience', 'like', "%$experiences%");
            });
        }
        $jobs = $query->orderBy('created_at', 'DESC')->paginate(20);
        //$jobs->appends(['name'=> $post_name]);
        Session::flash('_old_input', $request->all());
        return view('front.jobs.search',
            compact(
                'jobs', 'cities', 'top_jobs', 'company', 'category',
                'industry', 'feature_posts', 'feature_functions', 'feature_industries',
                'feature_companies', 'feature_cities'
            )
        );
    }
}
