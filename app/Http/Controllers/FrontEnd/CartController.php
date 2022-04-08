<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function addtocart(Request $request)
    {


        $prod_id=$request->prod_id1;
        $product_qty=$request->product_qty1;
        
        if(auth()->guard('web')->check())
        {
          $user_id=auth()->guard('web')->user()->id;

          $prod=Product::where('id',$prod_id)->first();
          //  return response()->json(['status'=>$prod->id.'+ name>>'.$prod->name]);
          if($prod)
          {
              if(Cart::where('prod_id',$prod_id)->where('user_id',$user_id)->exists())
              {
                return response()->json(['status'=>$prod->name.'items Already Exists']);
              }
              else
              {
                $cart=new Cart();
                $cart->prod_id=$prod_id;
                $cart->user_id=$user_id;
                $cart->prod_qty=$product_qty;
                $cart->save();
                return response()->json(['status'=>$prod->name.'Add To Cart Succes']);
              }
            

          }

       }

       else
       {
        return response()->json(['status' => "Login To contiune"]);
       }

    }

    public function viewcart()
    {
      $user_id=auth()->guard('web')->user()->id;
      $cartitems=Cart::where('user_id',$user_id)->get();
     //  return $cartitems;
       return view('front.carts.cart',compact('cartitems'));

    }

    public function deleteproduct(Request $request)
    {

      if(auth()->guard('web')->check())
       {
        $user_id=auth()->guard('web')->user()->id;

        $prod_id=$request->prod_id1;
        if(Cart::where('prod_id',$prod_id)->where('user_id',$user_id)->exists())
        {

          $cartitem=Cart::where('prod_id',$prod_id)->where('user_id',$user_id)->first();
          $cartitem->delete();
          return response()->json(['status' => $prod_id. "item Delte Sucees"]);

        }
       }
      else{
        return response()->json(['status' => "Login To contiune"]);

      }

    }

    public function updatecart(Request $request)
    {
      // return response()->json(['prod_id'=>$request->prod_id1]);

      $prod_id=$request->prod_id1;
      $prod_qty=$request->prod_qty1;
      if(auth()->guard('web')->check())
      {
        $user_id=auth()->guard('web')->user()->id;

        if(Cart::where('prod_id',$prod_id)->where('user_id',$user_id)->exists())
        {
          $cart=Cart::where('prod_id',$prod_id)->where('user_id',$user_id)->first();
           $cart->prod_qty=$prod_qty;
           $cart->update();
           return response()->json(['status'=>'Quantity Updated']);
        }

      }
    }

    public function cartcount()
    {
      $user_id=auth()->guard('web')->user()->id;
      $cartcount=Cart::where('user_id',$user_id)->count();
       return response()->json(['count'=>$cartcount]);
    }

  }
