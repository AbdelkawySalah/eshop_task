<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Notification;
use App\Notifications\ChangeOrderStatus;
use App\Models\Admin;
class OrderController extends Controller
{
    public function index()
    {
        $user=Admin::first();
        $data['orders']=Order::get();
          return view('admin.orders.index')->with($data);
    }

    public function view($id)
    {
        $order=Order::where('id',$id)->first();
        return view('admin.orders.vieworder',compact('order'));
    }

    public function orderstatus($id)
    {  
        $order=Order::findorfail($id);
        if($order->status==0)
        {
            DB::table('orders')->where('id',$order->id)->update(
                ['status'=>'1']);
        }
        

        return redirect(route('admin.orders.index'));
    }

}
