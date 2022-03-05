<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index(){
        return view('Patient.patient_dash');
    }

    public function Logout(){
        Auth::logout();
        return Redirect()->route('login');
    }

}
