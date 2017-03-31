<?php

namespace App\Http\Controllers;

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
        $posts = $this->post->all();
        return view('front.index', compact('posts'));
    }

    public function getPost()
    {
        return view('employee.post.index');
    }
}
