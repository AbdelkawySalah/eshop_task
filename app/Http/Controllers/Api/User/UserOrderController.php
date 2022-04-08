<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\Product;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
class UserOrderController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
         $user_id=auth()->guard('userapi')->user()->id;
         $orders=Order::where('user_id',$user_id)->get();
        if($orders) return $this->apiResponse($orders,'ok',201); else $this->apiResponse('','Error in data',400);

    }
    public function addtocart(Request $request)
    {

        $data=Validator::make($request->all(),[
            'prod_id1'=>'required|numeric',
            'product_qty1'=>'required|numeric',
           
        ]);
       
        if($data->fails())
        {
            return $this->apiResponse('',$data->errors(),400);
        } 
        $prod_id=$request->prod_id1;
        $product_qty=$request->product_qty1;
        
        if(auth()->guard('userapi')->check())
        {
          $user_id=auth()->guard('userapi')->user()->id;

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
      $user_id=auth()->guard('userapi')->user()->id;
      $cartitems=Cart::where('user_id',$user_id)->get();
     
      if($cartitems) return $this->apiResponse($cartitems,'ok',201); else $this->apiResponse('','No data found',404);

    }

    public function placeorder(Request $request)
    { 
      $user_id=auth()->guard('userapi')->user()->id;
      $data=Validator::make($request->all(),[
        'fname'=>'required',
        'lname'=>'required',
        'email'=>'required',
        'phone'=>'required',
        'address1'=>'required',
        'address2'=>'required',
        'city'=>'required',
        'state'=>'required',
        'country'=>'required',
        'pincode'=>'required',
    ]);
   
    if($data->fails())
    {
        return $this->apiResponse('',$data->errors(),400);
    } 

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

       
        $cartitems=Cart::where('user_id',$user_id)->get();
        $cart=Cart::destroy($cartitems);
        if($cart) return $this->apiResponse('','Order add Success',201); else $this->apiResponse('','No data found',404);
    
    }

    
}
