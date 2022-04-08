<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiResponseTrait;

class CatController extends Controller
{
use ApiResponseTrait;
    public function index()
    {
        $cats=Cat::orderby('id','desc')->get();
        return $this->apiResponse($cats,"ok",200);
        // $array=[
        //     'data'=>$cats,
        //     'msg'=>'ok',
        //     'status'=>'201'
        // ];
        // return response($array);
    }

    public function store(Request $request)
    {
      
        $data = Validator::make($request->all(), [
            'name'=>'required|string|max:191|unique:cats',
            'slug'=>'required',
            'description'=>'required|max:200',
            'image'=>'required|mimes:jpg,png',
           ]);
        if($data->fails())
        {
            return $this->apiResponse('',$data->errors(), 400);
        }
      
          if($request->hasfile('image'))
          {
            $image=$request->image->hashName();
            $file=$request->file('image'); 
            $file->move('admin/uploads/cats',$image);
          }
          $cats=Cat::create([
              'name'=>$request->name,
              'slug'=>$request->slug,
              'description'=>$request->description,
              'image'=>$image,
              'status'=>1,
          ]);
          if($cats) return $this->apiResponse('','data add Success',201); else $this->apiResponse('','Error in add catgory',400);
        
    }
    public function showcatgory($id)
    {
        $category=Cat::findorfail($id);
        if($category) return $this->apiResponse($category,'ok',201); else return $this->apiResponse('','Error no data found',404);
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
        if($cat) return $this->apiResponse('','data deleted success',201); else return $this->apiResponse('','Error no delete found',404);

    }

    public function update(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name'=>'required|string|max:191|unique:cats,name,'.$request->cat_id,
            'slug'=>'required',
            'description'=>'required|max:200',
            'image'=>'nullable|mimes:jpg,png',
            'cat_id'=>'required|numeric',
           ]);
        if($data->fails())
        {
            return $this->apiResponse('',$data->errors(), 400);
        }
      
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
            $image= $file->hashName();
            $file->move('admin/uploads/cats',$image);
         }
 
         else{
           $image=$old_img;
         }
 
         $cats=Cat::findorfail($request->cat_id)->update([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'description'=>$request->description,
            'image'=>$image,
         ]);
         if($cats) return $this->apiResponse('','data updated success',201); else return $this->apiResponse('','Error no delete found',404);

 
    }
}
