<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Auth;
use App\Models\User;
class CheckOutController extends Controller
{
    public function index()
    {
      $user_id=auth()->guard('web')->user()->id;

      $old_cartitems=Cart::where('user_id',$user_id)->get();
      // return $old_cartitems;
      foreach($old_cartitems as $item)
      {
        //بقوله هنا لو كميه اللي موجود في المخزن اقل من كميه الموجوده في كارت يبقي نحذفه من كارت 
        if(!Product::where('id',$item->prod_id)->where('qty','>',$item->prod_qty))
          {
                $removeitem=Cart::where('user_id',$user_id)->where('prod_id',$item->prod_id)->first();
                $removeitem->delete();
          }
      }
      
        $cartcheck=Cart::where('user_id',$user_id)->get();
        return view('front.carts.checkout',compact('cartcheck'));
    }

    public function placeorder(Request $request)
    { 
      $user_id=auth()->guard('web')->user()->id;
  
      $order=new Order();
        $order->user_id=$user_id;
        $order->fname=$request->fname;
        $order->lname=$request->lname;
        $order->email=$request->email;
        $order->phone=$request->phone;
        $order->address1=$request->address1;
        $order->address2=$request->address2;
        $order->city=$request->city;
        $order->state=$request->state;
        $order->country=$request->country;
        $order->pincode=$request->pincode;
        $order->tracking_no='Eshop'.rand(1111,9999);
        //to caclaulate Total_price
        $total=0;
        $cartitems_total=Cart::where('user_id',$user_id)->get();
        foreach($cartitems_total as $prod)
        {
           $total +=$prod->products->selling_price;
        }
        $order->total_price=$total;

        $order->save();

        $cartitems=Cart::where('user_id',$user_id)->get();
        foreach($cartitems as $item)
        {
          OrderItem::create([
            'order_id'=>$order->id,
            'prod_id'=>$item->prod_id,
            'qty'=>$item->prod_qty,
            'price'=>$item->products->selling_price,
          ]);
          //عشان ااقل كميه من مخزن 
          $prod=Product::where('id',$item->prod_id)->first();
          $prod->qty=$prod->qty-$item->prod_qty;
          $prod->update();
        }

        // if(Auth::user()->address1 ==NuLL)
            // {
            //   $user=User::where('id',Auth::id()->first());
            // }
        $cartitems=Cart::where('user_id',$user_id)->get();
        Cart::destroy($cartitems);
        return redirect('/')->with('status','Orderd Placed Succesfuly');
            
    }

    public function pay(Request $request)
    {
      $user_id=auth()->guard('web')->user()->id;

      $cartitems=Cart::where('user_id',$user_id)->get();
      $total_price=0;
      foreach($cartitems as $item)
      {
        $total_price +=$item->products->selling_price * $item->prod_qty;
       
      }
        // $firstname=$request->firstname;
        // $lastname=$request->lastname;
        //  $email=$request->email;
        //  $phone=$request->phone;
        //  $address1=$request->address1;
        //  $address2=$request->address2;
        //  $city=$request->city;
       return response()->json([
        'total_price'=>$total_price,
        // 'firstname'=>$firstname,
        // 'lastname'=>$lastname,
        // 'email'=>$email,
        // 'phone'=>$phone,
        // 'address1'=>$address1,
        // 'address2'=>$address2,
        // 'city'=>$city,
       ]);
    }
}
