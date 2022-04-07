<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist=Wishlist::where('user_id',Auth::id())->get();
        return view('front.carts.wishlist',compact('wishlist'));
    }

    //add to wishlist
    public function add(Request $request)
    {
      if(Auth::check())
      {
        $prodid=$request->prod_id1;
           
         //check if prduct exists in wishlist مسبقا
         if(Wishlist::where('prod_id',$prodid)->where('user_id',Auth::id())->exists())
         {
             return response()->json(['status'=>'Product aready exists in wishlist']);
         }
        
         //for add in wishlist
        if(Product::findorfail($prodid))
            {
               
                $wishlist=new Wishlist();
                $wishlist->user_id=Auth::id();
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

        if(Auth::check())
        {
            $prod_id=$request->prod_id1;
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $wish=Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
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
        $wishlistcount=Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$wishlistcount]);
    }
}
