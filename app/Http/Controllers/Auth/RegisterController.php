<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'candidate/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'phone_number' => 'required|max:14|unique:users',
            'terms' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $records = User::all()->count();
        $current_id = 1;
        if (!$records == 0) {
            $current_id = User::all()->last()->id + 1;
        }
        $enroll_id = 'TMP_CD' . date('Y') . str_pad($current_id, 5, '0', STR_PAD_LEFT);
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'terms' => $data['terms'],
            'phone_number' => $data['phone_number'],
            'password' => bcrypt($data['password']),
            'confirm_code' => str_random(30),
            'enroll_temp' => $enroll_id,
        ]);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($token)
    {
        try {
            User::where('confirm_code', $token)->firstOrFail()->verified();
        } catch (ModelNotFoundException $exception) {
            return back()->with('status', 'The token already used, or broken.');
        }
        return redirect()->route('login')
            ->withInput()
            ->with('success', 'Your account is activated successfully, Plz login to post your job.');
    }
}
