<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $data['users']=User::get();
        return view('admin.index')->with($data);
    }

    public function changestatus($id)
    {
        $data['user']=User::findorfail($id);
        return view('admin.users.buyerstatus')->with($data);
        
    }

    public function updatestatus(Request $request)
    {
       
        $user=User::findorfail($request->user_id)->update([
            'status'=>($request->status==True?'1':'0')
        ]);
        return redirect(route('admin.home'));
    }

    public function add_buyer()
    {
        return view('admin.users.add');
    }

    public function store_buyer(Request $request)
    {
        $data=$request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);
        User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>1,
        ]);
        return redirect(route('admin.home'));
    }

    public function edit_buyer($id)
    {
      $data['user']=User::findorfail($id);
        return view('admin.users.edit')->with($data);
    }

    public function update_buyer(Request $request)
    {
        $data=$request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$request->user_id,
            'password'=>'required'
        ]);
        User::findorfail($request->user_id)->update([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>($request->status==True?'1':'0'),
        ]);
      
        return redirect(route('admin.home'));
    }

}
