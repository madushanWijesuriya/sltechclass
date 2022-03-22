<?php

namespace App\Http\Overrides;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait NewAuthUser
{
    use \Illuminate\Foundation\Auth\AuthenticatesUsers;
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if ($request->has('student')){
            if (User::where('codice_id',$request->email)->exists()){
                if (Hash::check($request['password'], User::where('codice_id',$request->email)->first()->password)) {
                    if ($this->attemptLogin($request)) {
                        if ($request->hasSession()) {
                            $request->session()->put('auth.password_confirmed_at', time());
                        }

                        return $this->sendLoginResponse($request);
                    }
                }
            }
        }else{
            if ($this->attemptLogin($request)) {
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }

                return $this->sendLoginResponse($request);
            }
        }



        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    public function showStudentLoginForm()
    {
        return view('auth.login_student');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        if ($request->has('student')){
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect()->intended($this->redirectPathStudet());
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }
    public function redirectPathStudet()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        return route('student-class.dashboard');
    }
    protected function attemptLogin(Request $request)
    {
        if ($request->has('student')){
           return Auth::attempt(['name' => $request->email, 'password' => request('password')], $request->filled('remember'));
        }
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
}
