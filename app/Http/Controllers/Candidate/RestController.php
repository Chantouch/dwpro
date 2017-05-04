<?php

namespace App\Http\Controllers\Candidate;

use App\Models\UserProfile;
use App\User;
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
        $candidate = $this->auth()->with(['profile.city', 'verified_by'])->firstOrFail();
        return response()->json($candidate);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_about_me(Request $request)
    {
        $profile = UserProfile::with('candidate')->where('user_id', $this->auth()->id)->firstOrFail();
        $update = $profile->update($request->all());
        if (!$update) {
            return response()->json(['error' => 'Can not update your profile now.']);
        }
        return response()->json(['message' => 'Your profile updated successfully.']);
    }


    public function auth()
    {
        return auth()->guard()->user();
    }
}
