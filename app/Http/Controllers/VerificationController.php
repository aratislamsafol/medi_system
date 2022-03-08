<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($token){
        $user=User::where('remember_token',$token)->first();

        if(!is_null($user)){
            $user->remember_token=NULL;
            $user->status=1;
            $user->save();
            // return Redirect()->back()->with('success','Registerd SuccessFully,login Now');
            return redirect()->route('login')->with('success','Registerd SuccessFully,login Now');;

        }else{
            return Redirect()->route('verification')->with('error','User is not verified.need to verify');
        }
    }
}
