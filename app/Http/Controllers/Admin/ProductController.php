<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cat;

use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
       $data['products']=Product::orderby('id','desc')->get();
      return view('admin.Products.index')->with($data);
    }

    public function create()
    {
      $data['cats']=Cat::select('id','name')->get();
      return view('admin.Products.create')->with($data);
    }

    public function store(Request $request)
    {
        $data=$request->validate([
          'name'=>'required|string|max:40|unique:products',
          'cate_id'=>'required|exists:cats,id',
          'slug'=>'required',
          'small_description'=>'required|max:40|min:4',
          'description'=>'required',
          'original_price'=>'required|integer',
          'selling_price'=>'required|integer',
          'qty'=>'required|numeric',
          'tax'=>'required',
          'image'=>'required|image|mimes:jpg,png,jpeg,gif'
        ]);

       
        if($request->hasfile('image'))
        {
          $data['image']=$request->image->hashName();
          $file=$request->file('image'); 
          $file->move('admin/uploads/prods',$data['image']);
        }

        $data['status']=($request->status=='Ture'?'1':'0');
        $data['trending']=($request->trending=='Ture'?'1':'0');

        Product::create($data);
        return redirect(route('admin.product.index'));

    }

    public function edit($id)
    {
      $data['product']=Product::findorfail($id);
      $data['cats']=Cat::select('id','name')->get();
      return view('admin.Products.edit')->with($data);
    }

    public function update(Request $request)
    {
      $data=$request->validate([
        'name'=>'required|string|max:40|unique:products,name,'.$request->prod_id,
        'prod_id'=>'required|exists:products,id',
        'slug'=>'required',
        'small_description'=>'required|max:40|min:4',
        'description'=>'required',
        'original_price'=>'required|integer',
        'selling_price'=>'required|integer',
        'qty'=>'required|numeric',
        'tax'=>'required',
        'image'=>'mimes:jpg,png,jpeg,gif'
      ]);
     
        $old_img=Product::findorfail($request->prod_id)->image;
        
        if($request->hasfile('image'))
        {
           $path="admin/uploads/Prods/".$old_img;
           if(File::exists($path))
           {
             File::delete($path);
           }
           $file=$request->file('image');
           $data['image']=$data['image']->hashName();
           $file->move('admin/uploads/Prods',$data['image']);
        }

        else{
          $data['image']=$old_img;
        }
        $data['status']=($request->status=='Ture'?'1':'0');
        $data['trending']=($request->trending=='Ture'?'1':'0');
        Product::findorfail($request->prod_id)->update($data);
        return redirect(route('admin.product.index'));

    }

    public function delete($id)
    {
     
      $Product=Product::findorfail($id);
      $path="admin/uploads/Prods/".$Product->image;
      if(File::exists($path))
      {
          File::delete($path);
      }
      $Product->delete();
      return back();
    }
}
