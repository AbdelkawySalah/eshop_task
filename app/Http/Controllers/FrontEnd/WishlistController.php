<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Auth;
class WishlistController extends Controller
{
   
    public function index()
    {
        $user_id=auth()->guard('web')->user()->id;
        $wishlist=Wishlist::where('user_id',$user_id)->get();
        return view('front.carts.wishlist',compact('wishlist'));
    }

    //add to wishlist
    public function add(Request $request)
    {
      if(auth()->guard('web')->check())
      {
        $user_id=auth()->guard('web')->user()->id;
        $prodid=$request->prod_id1;
           
         //check if prduct exists in wishlist مسبقا
         if(Wishlist::where('prod_id',$prodid)->where('user_id',$user_id)->exists())
         {
             return response()->json(['status'=>'Product aready exists in wishlist']);
         }
        
         //for add in wishlist
        if(Product::findorfail($prodid))
            {
               
                $wishlist=new Wishlist();
                $wishlist->user_id=$user_id;
                $wishlist->prod_id=$prodid;
                $wishlist->save();
                return response()->json(['status'=>'product add to wishlist']);

            }
            else
            {
                return response()->json(['status'=>'product not exists']);
            }

       }
      else{
           return response()->json(['status'=>'Login To continue']);

           }
    }

    public function remove(Request $request)
    {

        if(auth()->guard('web')->check())
        {
            $user_id=auth()->guard('web')->user()->id;
            $prod_id=$request->prod_id1;
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',$user_id)->exists())
            {
                $wish=Wishlist::where('prod_id',$prod_id)->where('user_id',$user_id)->first();
                $wish->delete();
                return response()->json(['status'=>'item Remove Fom wishlist']);
            }
           
        }
        else{
            return response()->json(['status'=>'Login To system']);

        }
    }

    public function wishlistcount()
    {
        $user_id=auth()->guard('web')->user()->id;
        $wishlistcount=Wishlist::where('user_id',$user_id)->count();
        return response()->json(['count'=>$wishlistcount]);
    }
}
