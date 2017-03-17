<?php

namespace App\Http\Controllers\Employee;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\HashidsManager;

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
            'functions', 'contact'
        ])->paginate(10);
        return response()->json($posts);
    }
}
