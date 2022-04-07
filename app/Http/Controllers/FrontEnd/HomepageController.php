<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cat;

class HomepageController extends Controller
{
    public function index()
    {
       $data['category']=Cat::where('status',1)->get();
        return view('home',$data);
    }

    public function showproducts($id)
    {
        $data['category']=Cat::where('id',$id)->select('id','name')->first();
        $data['products']=Product::where('cate_id',$id)->get();
        return view('front.products.index',$data);
    }

    public function viewproduct($id)
    {
        $data['product']=Product::findorfail($id);
        return view('front.products.viewproduct',$data);
    }
}

