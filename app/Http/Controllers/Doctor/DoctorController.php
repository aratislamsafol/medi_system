<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index(){
        return view('Doctor.doctor_dash');
    }

    public function Logout(){
        Auth::logout();
        return Redirect()->route('login');
    }

}
