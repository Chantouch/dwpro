<?php

namespace App\Http\Controllers\Api\Employee;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\HashidsManager;

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
        //$this->middleware('auth:employee');
        $this->post = $post;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all_posts()
    {
        $employee_id = Auth::guard('employee')->id();
        $posts = $this->post->where('employee_id', $employee_id)->with([
            'industry', 'city', 'qualification', 'level', 'contract_type',
            'functions', 'contact'
        ])->paginate(10);
        return response()->json($posts);
    }
}
