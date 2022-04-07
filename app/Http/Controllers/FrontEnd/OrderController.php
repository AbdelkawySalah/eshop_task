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
        $orders=Order::where('user_id',Auth::id())->get();
        return view('front.orders.index',compact('orders'));
    }

    public function vieworder($id)
    {
        $order=Order::where('id',$id)->where('user_id',Auth::id())->first();
        return view('front.orders.view-order',compact('order'));

    }
}
