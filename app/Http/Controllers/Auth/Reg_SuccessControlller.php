<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Reg_SuccessControlller extends Controller
{
    public function index(){
        return view('auth.reg_verify');
    }
}
