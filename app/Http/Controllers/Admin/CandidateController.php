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


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = "Candidate List";
        return view('admin.candidates.index', compact('title'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_un_active()
    {
        $title = "Candidate List";
        return view('admin.candidates.un-active', compact('title'));
    }

    public function show($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = $decoded[0];
        if (!$id){
            return back()->with('error', 'We can not find this candidate, Please try other candidate');
        }
        $candidate = User::with('verified_by')->find($id);

        return response()->json($candidate);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_un_verify()
    {
        $title = "Candidate List";
        return view('admin.candidates.un-verify', compact('title'));
    }

}
