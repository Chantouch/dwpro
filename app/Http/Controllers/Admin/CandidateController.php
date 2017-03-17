<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $title = "Show candidate";
        $decoded = $this->hashid->decode($id);
        $id = $decoded[0];
        if (!$id) {
            return back()->with('error', 'We can not find this candidate, Please try other candidate');
        }
        $candidate = User::with('verified_by')->find($id);
        return view('admin.candidates.show', compact('candidate', 'title'));
    }

    public function show_un_verify($id)
    {
        $title = "Show candidate";
        $decoded = $this->hashid->decode($id);
        $id = $decoded[0];
        if (!$id) {
            return back()->with('error', 'We can not find this candidate, Please try other candidate');
        }
        $candidate = User::with('verified_by')->find($id);
        return view('admin.candidates.show', compact('candidate', 'title'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_un_verify()
    {
        $title = "Candidate List";
        return view('admin.candidates.un-verify', compact('title'));
    }

    public function verify_candidate($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = $decoded[0];
        if (!$id) {
            return redirect()->back()->with('error', 'We can not find this specific candidate.');
        }
        $verify = User::with('verified_by')->find($id);
        if ($verify->verified_by !== null) {
            return redirect()->back()->with('error', 'This candidate is already verified. You don\'s need to verify again.');
        }
        $verify->verified_by = Auth::guard('admin')->id();
        $verify->enroll_id = str_replace('TEMP_', '', $verify->enroll_temp);
        $verify->enroll_temp = null;
        if (!$verify->save()) {
            return redirect()->back()->with('error', 'We can not process your request right now, please contact administrator for help.');
        } else {
            return back()->with('success', 'Candidate verified successfully.');
        }
    }

    public function change_status($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = $decoded[0];
        if (!$id) {
            return redirect()->back()->with('error', 'We can not find this specific candidate.');
        }
        $status = User::with('verified_by')->find($id);
        if ($status->status !== 0) {
            return redirect()->back()->with('error', 'This candidate is already enabled. You don\'s need to enable again.');
        }
        $status->status = 1;
        if (!$status->save()) {
            return redirect()->back()->with('error', 'We can not process your request right now, please contact administrator for help.');
        } else {
            return back()->with('success', 'Candidate enabled successfully.');
        }
    }
}
