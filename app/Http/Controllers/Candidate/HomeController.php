<?php

namespace App\Http\Controllers\Candidate;

use App\Models\City;
use App\Models\ContractType;
use App\Models\Industry;
use App\Models\Language;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\HashidsManager;

class HomeController extends Controller
{

    public $hashid;

    public function __construct(HashidsManager $hashid)
    {
        $this->middleware('auth');
        $this->hashid = $hashid;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Your home page';
        $auth = auth()->guard()->user();
        $progress = 0;
        if (count($auth->profile) == 1)
            $progress = 20;
        $contract_type = ContractType::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $industries = Industry::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $languages = Language::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $cd_status = \Helper::candidate_status();
        $desired_salary = \Helper::salary();
        $language_level = \Helper::language_level();
        $skill_level = \Helper::skill_level();
        $skill_year = \Helper::skill_year();
        return view('candidate.home',
            compact(
                'title', 'progress', 'auth', 'cd_status', 'contract_type',
                'desired_salary', 'industries', 'cities', 'language_level', 'languages',
                'skill_level', 'skill_year'
            )
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit_personal($id)
    {
        $progress = 0;
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return redirect()->back()->with('error', 'We can not find your info.');
        }
        $auth = auth()->guard()->user();
        $profile = $auth->profile->find($id);
        if (count($auth->profile) == 1)
            $progress = 20;
        return view('candidate.personal', compact('auth', 'progress', 'profile'));
    }
}
