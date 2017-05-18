<?php

namespace App\Http\Controllers\Candidate;

use App\Models\City;
use App\Models\ContractType;
use App\Models\Functions;
use App\Models\Industry;
use App\Models\Language;
use App\Models\Level;
use App\Models\UserExperience;
use App\Models\UserProfile;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\HashidsManager;
use Validator;
use DB;

class HomeController extends Controller
{

    public $hashid;

    public function __construct(HashidsManager $hashid)
    {
        $this->middleware('auth');
        $this->hashid = $hashid;
    }

    public function auth()
    {
        return auth()->guard()->user();
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
        if (count($auth->work_experience) >= 1)
            $progress = 25;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit_personal()
    {
        $progress = 0;
        $auth = $this->auth();
        $profile = $auth->profile;
        if (count($auth->profile) == 1)
            $progress = 20;
        return view('candidate.personal', compact('auth', 'progress', 'profile'));
    }

    public function create()
    {
        $progress = 0;
        $auth = $this->auth();
        $profile = $auth->profile;
        if (count($auth->profile) == 1)
            $progress = 20;

        $contract_type = ContractType::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $industries = Industry::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $languages = Language::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $job_roles = Functions::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $cities = City::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $cd_status = \Helper::candidate_status();
        $desired_salary = \Helper::salary();
        $language_level = \Helper::language_level();
        $levels = Level::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $skill_year = \Helper::skill_year();
        return view('candidate.create', compact('auth', 'progress', 'profile', 'cd_status', 'contract_type',
            'desired_salary', 'industries', 'cities', 'language_level', 'languages', 'job_roles',
            'levels', 'skill_year'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $validator = Validator::make($data, UserExperience::rules(), UserExperience::messages());
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $data['start_date'] = date('Y-m-d', strtotime(str_replace('-', '-', $request['start_date'])));
            $data['user_id'] = $this->auth()->id;
            $save = UserExperience::create($data);
            if (!$save) {
                DB::rollback();
                return redirect()->back()->with('error', 'Error while saving your work experience.');
            }
            DB::commit();
            return redirect()->route('candidate.home')->with('message', 'Work experience saved successfully');

        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Error while saving your work experience.');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $progress = 0;
        $auth = $this->auth();
        $profile = $auth->profile;
        if (count($auth->profile) == 1)
            $progress = 20;
        return view('candidate.edit', compact('auth', 'progress', 'profile'));
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, UserProfile::rule(), UserProfile::message());
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $update = $this->auth()->profile->update($data);
            if (!$update) {
                return redirect()->back()->with('error', 'Error while update your profile.');
            }
            return redirect()->route('candidate.home')->with('message', 'Updated successfully');
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Error while update your profile.');
        }
    }
}
