<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Notifications\ChangeOrderStatus;
use App\Models\Admin;
use App\Http\Controllers\Api\ApiResponseTrait;

class OrderController extends Controller
{
   use ApiResponseTrait;
    public function index()
    {
        $orders=Order::paginate(10);
        if($orders) return $this->apiResponse($orders,'ok',201); else $this->apiResponse('','No product Found',404);

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
                return $this->apiResponse('','Status upated ',201); 

        }
        return $this->apiResponse('','status alraedy updated to complete ',404);

    }

}
