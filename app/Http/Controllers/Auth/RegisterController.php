<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Notifications\VerifyRegistration;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\DoctorRegCheck;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @override
     * Show registrationform override
     * Compact Distric & Divison for Registration Page
     *
     *
     */
    public function showRegistrationForm()
    {
        $districts = District::orderBy('district_name', 'asc')->get();
        $divisions = Division::orderBy('prioroty', 'asc')->get();
        return view('auth.register',compact('districts','divisions'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'f_name' => ['required', 'string', 'max:50'],
            // 'l_name' => ['required', 'string', 'max:50'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'phone' => ['required', 'max:15'],
            // 'division_id' => ['required','numeric'],
            // 'distric_id' => ['required','numeric'],
            // 'street_address' => ['required', 'max:100'],
            // 'specialist_category' => ['required', 'string', 'max:150'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(Request $request)
    {
        // dd($request->all());
        if($request->specialist_category == 'patient'){
            $user= User::create([
                'f_name' =>  $request->f_name,
                'l_name' =>  $request->l_name,
                'user_name'=>($request->l_name.rand(1,3000)),
                'age'=> $request->age,
                'phone' =>  $request->phone,
                'email' =>  $request->email,
                'status' => 0,
                'street_address' =>  $request->street_address,
                'division_id' => $request->division_id,
                'district_id' => $request->distric_id,
                'ip_address' =>request()->ip(),
                'role_id' => 3,
                'specialist_category' =>$request->specialist_category,
                'blood_group'=> $request->blood_group,
                'password' => Hash::make($request->password),
                'remember_token' =>Str::random(40),
            ]);

            $user->notify(new VerifyRegistration($user));

            session()->flash('success', 'A confirmation email has sent to you.. Please check and confirm your email');
            return redirect()->route('verification');
        }else{
            // $user= User::create([
            //     'f_name' =>  $request->f_name,
            //     'l_name' =>  $request->l_name,
            //     'user_name'=>($request->l_name.rand(1,3000)),
            //     'age'=> $request->age,
            //     'phone' =>  $request->phone,
            //     'email' =>  $request->email,
            //     'status' => 0,
            //     'street_address' =>  $request->street_address,
            //     'division_id' => $request->division_id,
            //     'district_id' => $request->distric_id,
            //     'ip_address' =>request()->ip(),
            //     'role_id' => 3,
            //     'specialist_category' =>$request->specialist_category,
            //     'blood_group'=> $request->blood_group,
            //     'password' => Hash::make($request->password),
            //     'remember_token' =>Str::random(40),
            // ]);
            DoctorRegCheck::create([
                'designation'=>$request->designation,
                'expertise'=>$request->expertise,
                'certificate'=>$request->certificate,
            ]);

            // $user->notify(new VerifyRegistration($user));

            // session()->flash('success', 'A confirmation email has sent to you.. Please check and confirm your email');
            // return redirect()->route('verification');

        }

    }
}
