<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use Illuminate\Support\Facades\File;
class CatController extends Controller
{
    public function index()
    {
        $data['cats']=Cat::orderby('id','desc')->get();
        return view('admin.cats.index')->with($data);
    }

    public function create()
    {
        return view('admin.cats.create');

    }

    public function store(Request $request)
    {
        $data=$request->validate([
          'name'=>'required|string|max:191|unique:cats',
          'slug'=>'required',
          'description'=>'required|max:200',
          'image'=>'required|mimes:jpg,png',
        ]);

        if($request->hasfile('image'))
        {
          $data['image']=$request->image->hashName();
          $file=$request->file('image'); 
          $file->move('admin/uploads/cats',$data['image']);
        }
        Cat::create($data);
        return redirect(route('admin.cat.index'));
    }

    public function edit($id)
    {
        $data['category']=Cat::findorfail($id);
        return view('admin.cats.edit')->with($data);
    }

    public function update(Request $request)
    {
       $data=$request->validate([
           'name'=>'required|max:20|unique:cats,name,'.$request->cat_id,
       ]);
       $old_img=Cat::findorfail($request->cat_id)->image;
        
        if($request->hasfile('image'))
        {
           //هشيل الصورة الديمة
           $path="admin/uploads/cats/".$old_img;
           if(File::exists($path))
           {
             File::delete($path);
           }
           $file=$request->file('image');
           $data['image']= $file->hashName();
           $file->move('admin/uploads/cats',$data['image']);
        }

        else{
          $data['image']=$old_img;
        }

        Cat::findorfail($request->cat_id)->update($data);


      return redirect(route('admin.cat.index'));
    }

    public function destroy($id)
    {
        $cat=Cat::findorfail($id);
        $path="admin/uploads/cats/".$cat->image;
        if(File::exists($path))
        {
            File::delete($path);
        }
        $cat->delete();
        return back();
    }
}
