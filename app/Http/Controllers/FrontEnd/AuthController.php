<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view ('front.auth.login');
    }

    public function dologin(Request $request)
    {
        $data=$request->validate([
            'email'=>'required|email|max:30|exists:users',
            'password'=>'required|string'
        ]);
       
       
        if(!auth('web')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1]))
        {
             return back();
        }
        else
        {
           return redirect(route('front.homepage'));
        }

    }

    public function logout()
    {

      auth()->guard('web')->logout();
       return redirect(route('front.homepage'));
       
    }
}
