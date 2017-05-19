<?php

namespace App\Http\Controllers\Candidate;

use App\Models\Language;
use App\Models\UserLanguage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\HashidsManager;
use Validator;
use DB;

class LanguageController extends Controller
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
        $language = Language::where('status', 1)->orderBy('name')->pluck('name', 'id');
        $language_level = \Helper::language_level();
        return view('candidate.language', compact('auth', 'progress', 'language', 'language_level'));
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
            $validator = Validator::make($data, UserLanguage::rules(), UserLanguage::messages());
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $data['user_id'] = $this->auth()->id;
            $save = UserLanguage::create($data);
            if (!$save) {
                DB::rollback();
                return redirect()->back()->with('error', 'Error while saving your language.');
            }
            DB::commit();
            return redirect()->route('candidate.home')->with('message', 'Language saved successfully');

        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Error while saving your language.');
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
        $profile = $auth->work_experience->find($id);
        if (count($auth->profile) == 1)
            $progress = 20;
        if (count($auth->work_experience) >= 1)
            $progress = 25;
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
                return redirect()->route('admin.languages.index')->with('error', 'We can not find currency with that id, please try the other');
            }
            $experience = $this->auth()->work_experience->find($id);
            $validator = Validator::make($data, UserLanguage::rules(), UserLanguage::messages());
            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $update = $experience->update($data);
            if (!$update) {
                return redirect()->back()->with('error', 'Error while update your profile.');
            }
            DB::commit();
            return redirect()->route('candidate.home')->with('message', 'Your experience updated successfully');
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
            return redirect()->back()->with('error', 'We can not find language with that id, please try the other');
        }
        $experience = $this->auth()->work_experience->find($id);
        $delete = $experience->delete();
        if (!$delete) {
            return back()->with('error', 'Your language can not delete from your system right now. Plz try again later.');
        }
        return redirect()->back()->with('success', 'Your language deleted successfully');
    }
}
