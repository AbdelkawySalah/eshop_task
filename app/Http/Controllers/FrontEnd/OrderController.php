<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user_id=auth()->guard('web')->user()->id;
        $orders=Order::where('user_id',$user_id)->get();
        return view('front.orders.index',compact('orders'));
    }

    public function vieworder($id)
    {
        $user_id=auth()->guard('web')->user()->id;
        $order=Order::where('id',$id)->where('user_id',$user_id)->first();
        return view('front.orders.view-order',compact('order'));

    }
}
