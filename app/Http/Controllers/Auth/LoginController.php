<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyRegistration;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo(){
        if(Auth()->user()->role_id==1){
            return route('admin.dashboard');
        }elseif(Auth()->user()->role_id==2){
            return route('doctor.dashboard');
        }elseif(Auth()->user()->role_id==3){
            return route('patient.dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find User
        $user = User::where('email', $request->email)->first();

        if ($user->status == 1) {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                // Log Him Now
                return redirect()->intended(route('login'));
              }
        }else{
            if(!is_null($user)){
                $user->notify(new VerifyRegistration($user));

                return redirect()->route('verification')->with('success', 'A New confirmation email has sent to you.. Please check and confirm your email');
            }else{
                return redirect()->route('login')->with('errors', 'Please login first !!');
            }
        }

    }
}
