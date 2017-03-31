<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Models\City;
use App\Models\ContractType;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public $post;

    /**
     * Create a new controller instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->middleware('web');
        $this->post = $post;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->take(4)->get();
        $cities = City::where('status', 1)->orderBy('id', 'ASC')->pluck('name', 'id');
        $companies = Employee::where('status', 1)->get();
        $contract_terms = ContractType::where('status', 1)->get();
        $feature_posts = $this->post->all();
        $full_time_posts = Post::where('status', 1);
        $contract = array();
        foreach ($contract_terms as $contract_term) {
            $contract[] = $contract_term->id;
        }
        $full_time_posts->whereIn('contract_type_id', $contract);
        $full_time_posts = $full_time_posts->get();
        //dd($full_time);
        return view('front.index', compact(
            'posts', 'cities', 'feature_posts', 'companies',
            'contract_terms', 'full_time_posts'
        ));
    }

    public function getPost()
    {

        return view('employee.post.index');
    }
}
