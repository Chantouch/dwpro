<?php

namespace App\Http\Controllers\Candidate;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Your home page';
        $auth = auth()->guard()->user();
        $progress = 0;
        if (count($auth->profile) == 1)
            $progress = 20;

        return view('candidate.home', compact('title','progress','auth'));
    }
}
