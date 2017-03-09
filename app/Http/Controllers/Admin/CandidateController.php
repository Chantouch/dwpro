<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\HashidsManager;

class CandidateController extends Controller
{
    private $candidate;
    private $hashid;


    /**
     * CandidateController constructor.
     * @param User $candidate
     * @param HashidsManager $hashid
     */
    public function __construct(User $candidate, HashidsManager $hashid)
    {
        $this->candidate = $candidate;
        $this->hashid = $hashid;
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $title = "Candidate List";
        return view('admin.candidates.index', compact('title'));
    }
}
