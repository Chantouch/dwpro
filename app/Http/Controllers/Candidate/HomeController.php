<?php

namespace App\Http\Controllers\Candidate;

use App\Models\City;
use App\Models\ContractType;
use App\Models\Industry;
use App\Models\Language;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
}
