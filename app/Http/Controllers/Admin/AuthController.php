<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view ('admin.auth.login');
    }

    public function dologin(Request $request)
    {
        $data=$request->validate([
            'email'=>'required|email|max:30|exists:admins',
            'password'=>'required|string'
        ]);
       
        //مفروض هسنخدم كلاس الAuth او helperfunction auth()
        //helper function auth()>>have function attempt عشان تتاكد يوزده لوجين ولا لا
        //attempt >>بتاخد مصفوفة
        //attempt بتاخد باسورد اللي بكتبه ببتشفره وبتقارنه بعد كده بقيمه موجودة
        if(!auth('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']]))
        {
             //لو راجل ده مكنش عامل لوجين
             return back();
        }
        else
        {
           return redirect(route('admin.home'));
        }

    }

    public function logout()
    {

      auth()->guard('admin')->logout();
       return redirect(route('admin.login'));
       
    }
}
