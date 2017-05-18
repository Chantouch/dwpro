<?php

namespace App\Http\Controllers\Candidate;

use App\Models\City;
use App\Models\ContractType;
use App\Models\Functions;
use App\Models\Industry;
use App\Models\Language;
use App\Models\Level;
use App\Models\UserEducation;
use App\Models\UserExperience;
use App\Models\UserProfile;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\HashidsManager;
use Validator;
use DB;

class EducationController extends Controller
{
    public $hashid;

    public function __construct(HashidsManager $hashid)
    {
        $this->middleware('auth');
        $this->hashid = $hashid;
    }

    /**
     * @return mixed
     */
    public function auth()
    {
        return auth()->guard()->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $validator = Validator::make($data, UserEducation::rules(), UserEducation::messages());
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $data['start_date'] = date('Y-m-d', strtotime(str_replace('-', '-', $request['start_date'])));
            $data['user_id'] = $this->auth()->id;
            $save = UserEducation::create($data);
            if (!$save) {
                DB::rollback();
                return redirect()->back()->with('error', 'Error while saving education.');
            }
            DB::commit();
            return redirect()->route('candidate.home')->with('message', 'Your education saved successfully');

        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Error while saving your education.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return redirect()->back()->with('error', 'We can not find your experience.');
        }
        $progress = 0;
        $auth = $this->auth();
        $profile = $auth->education->find($id);
        if (count($auth->profile) == 1)
            $progress = 20;
        if (count($auth->education) >= 1)
            $progress = 25;
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
        return view('candidate.education.edit', compact('auth', 'progress', 'profile', 'cd_status', 'contract_type',
            'desired_salary', 'industries', 'cities', 'language_level', 'languages', 'job_roles',
            'levels', 'skill_year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $decoded = $this->hashid->decode($id);
            $id = @$decoded[0];
            if ($id === null) {
                return redirect()->route('admin.educations.index')->with('error', 'We can not find educations with that id, please try the other');
            }
            $education = $this->auth()->education->find($id);
            $validator = Validator::make($data, UserEducation::rules(), UserEducation::messages());
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $update = $education->update($data);
            if (!$update) {
                return redirect()->back()->with('error', 'Error while update your educations.');
            }
            return redirect()->route('candidate.home')->with('message', 'Your educations updated successfully');
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Error while update your educations.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $decoded = $this->hashid->decode($id);
        $id = @$decoded[0];
        if ($id === null) {
            return redirect()->back()->with('error', 'We can not find education with that id, please try the other');
        }
        $educations = $this->auth()->education->find($id);
        $delete = $educations->delete();
        if (!$delete) {
            return back()->with('error', 'Your educations can not delete from your system right now. Plz try again later.');
        }
        return redirect()->back()->with('success', 'Educations deleted successfully');
    }
}
