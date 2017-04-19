<?php

namespace App\Http\Controllers\Auth;

use App\Employee;
use App\Mail\EmployeeActivationAccount;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmployeeLoginController extends Controller
{

    use  ThrottlesLogins;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:employee', ['except' => 'logout']);
    }

    protected $redirectTo = "employee/home";

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/employee/home';
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.employee.login');
    }

    /**
     * Show the application's register form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.employee.register');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|email', 'password' => 'required|min:6',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    //For user register

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return Employee
     */
    protected function create(array $data)
    {
        //Generate Temp enrollment ID Job id
        $records = Employee::all()->count();
        $current_id = 1;
        if (!$records == 0) {
            $current_id = Employee::all()->last()->id + 1;
        }
        $enroll_id = 'TMP_EMP' . date('Y_M') . str_pad($current_id, 5, '0', STR_PAD_LEFT);

        return Employee::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirm_code' => str_random(30),
            'temp_enroll_no' => $enroll_id,
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function saveRegisterForm(Request $request)
    {
        $messages = array(
            'first_name.required' => 'Please enter first name',
            'last_name.required' => 'Please enter last name',
            'phone_number.required' => 'Please enter mobile phone',
            'email.required' => 'Please enter email',
            'email.unique' => 'This email is already taken. Please input a another email',
            'password.required' => 'Please enter password',
            'terms.required' => 'Please accept to our term and condition',
        );

        $rules = array(
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required',
            'email' => 'required|email|max:255|unique:employees',
            'password' => 'required|min:6|confirmed',
            'terms' => 'required',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
            return redirect('employee/register')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $employee = $this->create($request->all());
            $email = new EmployeeActivationAccount(new Employee([
                'first_name' => $employee->first_name,
                'confirm_code' => $employee->confirm_code,
            ]));
            Mail::to($employee->email)->send($email);
            DB::commit();
            if ($employee->id) {
                return redirect('/employee/login')->withInput()->with('success', 'You have successfully register with our website, please check your email to activate your account.');
            } else {
                return redirect('employee/register')->withInput()->with('error', 'Employer not register. Please try again');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors('status', 'Error while registering in our website, Please contact to our Teach Support');
        }
    }


    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($token)
    {
        try {
            Employee::where('confirm_code', $token)->firstOrFail()->verified();
        } catch (ModelNotFoundException $exception) {
            return back()->with('status', 'The token already used, or broken.');
        }
        return redirect('employee/login')->withInput()->with('status', 'You already activated your account, Please login here!');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('employee');
    }
}
