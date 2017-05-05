<?php

namespace App\Http\Controllers\Candidate;

use App\Models\UserExperience;
use App\Models\UserProfile;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestController extends Controller
{

    public $candidate;

    public function __construct(User $candidate)
    {
        $this->candidate = $candidate;
        $this->middleware('auth');
    }

    public function index()
    {
        $candidate = $this->auth()->with([
            'profile.city', 'verified_by', 'work_experience'
        ])->firstOrFail();
        return response()->json($candidate);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_about_me(Request $request)
    {
        $data = $request->all();
        try {
            $profile = UserProfile::with('candidate')->where('user_id', $this->auth()->id)->firstOrFail();
            $update = $profile->update($data);
            if (!$update) {
                return response()->json(['error' => 'Can not update your profile now.']);
            }
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Can not update your profile now.']);
        }
        return response()->json(['message' => 'Your profile updated successfully.']);
    }


    public function create_profile(Request $request)
    {
        $data = $request->all();
        try {
            $data['user_id'] = $this->auth()->id;
            $profile = UserProfile::create($data);
            if (!$profile) {
                return response()->json(['error' => 'Can not update your profile now.']);
            }
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Can not update your profile now.']);
        }
        return response()->json(['message' => 'Your profile updated successfully.']);
    }

    public function create_work_experience(Request $request)
    {
        $data = $request->all();
        try {
            $data['user_id'] = $this->auth()->id;
            $data['is_working'] = 1;
            $work_experience = UserExperience::create($data);
            if (!$work_experience) {
                return response()->json(['error' => 'Can not update your profile now.']);
            }
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Can not update your profile now.']);
        }
        return response()->json(['message' => 'Your profile updated successfully.']);
    }

    /**
     * @return mixed
     */
    public function auth()
    {
        return auth()->guard()->user();
    }
}
