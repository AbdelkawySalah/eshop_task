<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cat;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiResponseTrait;

class ProductController extends Controller
{
   use ApiResponseTrait;
    public function index()
    {
       $product=Product::orderby('id','desc')->paginate(10);
       if($product)  return $this->apiResponse($product,'ok',201);  
    }

  

    public function store(Request $request)
    {
        
        $data=Validator::make($request->all(),[
            'name'=>'required|string|max:40|unique:products',
            'cate_id'=>'required|exists:cats,id',
            'slug'=>'required',
            'small_description'=>'required|max:40|min:4',
            'description'=>'required',
            'original_price'=>'required|integer',
            'selling_price'=>'required|integer',
            'qty'=>'required|numeric',
            'tax'=>'required',
            'image'=>'required|image|mimes:jpg,png,jpeg,gif',
            'status'=>'required',
            'trending'=>'required'
        ]);
       
        if($data->fails())
        {
            return $this->apiResponse('',$data->errors(),400);
        } 

       
        if($request->hasfile('image'))
        {
          $image=$request->image->hashName();
          $file=$request->file('image'); 
          $file->move('admin/uploads/prods',$image);
        }


        $prod=Product::create([
            'name'=>$request->name,
            'cate_id'=>$request->cate_id,
            'slug'=>$request->slug,
            'small_description'=>$request->small_description,
            'description'=>$request->description,
            'original_price'=>$request->original_price,
            'selling_price'=>$request->selling_price,
            'qty'=>$request->qty,
            'tax'=>$request->tax,
            'image'=>$image,
            'status'=>($request->status=='Ture'?'1':'0'),
            'trending'=>($request->trending=='Ture'?'1':'0'),
        ]);
        
        if($prod) return $this->apiResponse('','product add Success',201); else $this->apiResponse('','Error in add catgory',400);


       

    }

    public function showproduct($id)
    {
      $product=Product::where('id',$id)->first();
      if($product) return $this->apiResponse($product,'ok',201); else $this->apiResponse('','No product Found',404);

    }

    public function update(Request $request)
    {
      $data=Validator::make($request->all(),[
        'prod_id'=>'required|exists:products,id',
        'name'=>'required|string|max:40|unique:products,name,'.$request->prod_id,
        'cate_id'=>'required|exists:cats,id',
        'slug'=>'required',
        'small_description'=>'required|max:40|min:4',
        'description'=>'required',
        'original_price'=>'required|integer',
        'selling_price'=>'required|integer',
        'qty'=>'required|numeric',
        'tax'=>'required',
        'image'=>'image|mimes:jpg,png,jpeg,gif',
        'status'=>'required',
        'trending'=>'required'

    ]);
     
     if($data->fails())
        {
            return $this->apiResponse('',$data->errors(),400);
        } 
        $old_img=Product::findorfail($request->prod_id)->image;
        
        if($request->hasfile('image'))
        {
           $path="admin/uploads/Prods/".$old_img;
           if(File::exists($path))
           {
             File::delete($path);
           }
           $file=$request->file('image');
           $image=$data->image->hashName();
           $file->move('admin/uploads/Prods',$image);
        }

        else{
          $image=$old_img;
        }
       
        $product=Product::findorfail($request->prod_id)->update([
          'name'=>$request->name,
          'cate_id'=>$request->cate_id,
          'slug'=>$request->slug,
          'small_description'=>$request->small_description,
          'description'=>$request->description,
          'original_price'=>$request->original_price,
          'selling_price'=>$request->selling_price,
          'qty'=>$request->qty,
          'tax'=>$request->tax,
          'image'=>$image,
          'status'=>($request->status=='Ture'?'1':'0'),
          'trending'=>($request->trending=='Ture'?'1':'0'),
        ]);
        if($product) return $this->apiResponse('','data updated success',201); else return $this->apiResponse('','Error no update ',404);

    }

    public function destroy($id)
    {
     
      $Product=Product::findorfail($id);
     
      $path="admin/uploads/Prods/".$Product->image;
      if(File::exists($path))
      {
          File::delete($path);
      }
      $Product->delete();
      if($Product) return $this->apiResponse('','data deleted success',201); else return $this->apiResponse('','Error no delete found',404);

    }

    
}
