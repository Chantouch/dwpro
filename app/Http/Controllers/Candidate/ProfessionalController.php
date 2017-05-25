<?php

namespace App\Http\Controllers\Candidate;

use App\Models\Language;
use App\Models\UserSkill;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\HashidsManager;
use Validator;
use DB;

class ProfessionalController extends Controller
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
        if (count($auth->profile) == 1)
            $progress = 20;
        if (count($auth->education) >= 1)
            $progress = 25;
        if (count($auth->work_experience) >= 1)
            $progress = 30;
        if (count($auth->language) >= 1)
            $progress = 35;
        $year_exp = \Helper::year_exp();
        $professional_level = \Helper::professional_level();
        return view('candidate.professional.create', compact('auth', 'progress', 'year_exp', 'professional_level'));
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
            $validator = Validator::make($data, UserSkill::rules(), UserSkill::messages());
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $data['user_id'] = $this->auth()->id;
            $data['level'] = $request->level;
            $data['year_exp'] = $request->year_exp;
            $save = UserSkill::create($data);
            if (!$save) {
                DB::rollback();
                return redirect()->back()->with('error', 'Error while saving your professional.');
            }
            DB::commit();
            return redirect()->route('candidate.home')->with('message', 'Professional skill saved successfully');

        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Error while saving your professional.');
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
        $year_exp = \Helper::year_exp();
        $professional_level = \Helper::professional_level();
        $profile = $auth->professional->find($id);
        if (count($auth->profile) == 1)
            $progress = 20;
        if (count($auth->work_experience) >= 1)
            $progress = 25;
        if (count($auth->professional) >= 1)
            $progress = 30;
        return view('candidate.professional.edit', compact('profile', 'progress', 'auth', 'year_exp', 'professional_level'));
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
                return redirect()->route('admin.professionals.index')->with('error', 'We can not find Professional skill with that id, please try the other');
            }
            $professional = $this->auth()->professional->find($id);
            $validator = Validator::make($data, UserSkill::rules(), UserSkill::messages());
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $data['level'] = $request->level;
            $data['year_exp'] = $request->year_exp;
            $update = $professional->update($data);
            if (!$update) {
                return redirect()->back()->with('error', 'Error while update your profile.');
            }
            DB::commit();
            return redirect()->route('candidate.home')->with('message', 'Professional skill updated successfully');
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Error while update your profile.');
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
            return redirect()->back()->with('error', 'We can not find professional with that id, please try the other');
        }
        $professional = $this->auth()->professional->find($id);
        $delete = $professional->delete();
        if (!$delete) {
            return back()->with('error', 'Your professional can not delete from your system right now. Plz try again later.');
        }
        return redirect()->back()->with('message', 'Your professional deleted successfully');
    }
}
