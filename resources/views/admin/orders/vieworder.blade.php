@extends('admin.layouts.master')
@section('title',' Orders')
@section('content')
  <div class="container py-5">
     <div class="row">
        <div class="col-md-12">
             <div class="card-header">
                 <h4>Order View
                 <a href="{{route('admin.orders.index')}}" class="btn btn-warning float-end">back</a>
                
                 </h4>
                </div>
             <div class="card-body">
               <div class="row">
                   <div class="col-md-6 order-details">
                      <h4>Shipping Details</h4>
                      <hr>
                       <label for="">First Name</label>
                        <div class="border p-2">{{$order->fname}}</div>
                        <label for="">Last Name</label>
                        <div class="border p-2">{{$order->lname}}</div>
                        <label for="">Email</label>
                        <div class="border p-2">{{$order->email}}</div>
                        <label for="">Contact No.</label>
                        <div class="border p-2">{{$order->phone}}</div>
                        <label for="">Shipping Address</label>
                        <div class="border p-2">
                        {{$order->address1}}
                        {{$order->address2}}
                        {{$order->city}}
                        {{$order->state}}
                        {{$order->country}}
                        </div>
                        <label for="">Zip Code</label>
                        <div class="border p-2">{{$order->pincode}}</div>


                   </div>
                   <div class="col-md-6">
                   <h4>Order Details</h4>
                   <hr>
                   <table class="table table-borderd">
               <thead>
                 <tr>
                    <th>Name</th>
                    <th>Quanity</th>
                    <th>Price</th>
                    <th>Image</th>
                 </tr>
               </thead>
                <tbody>
                @foreach($order->orderitems as $item)
                 <tr>
                     <td>{{$item->products->name}}</td>
                     <td>{{$item->qty}}</td>
                     <td>{{$item->price}}</td>
                     <td><img src="{{asset('admin/uploads/prods/'.$item->products->image)}}" width="50px"/></td>
                 </tr>
                @endforeach
                </tbody>
           </table>
           <h4>Grand Total:<span class="float-end">{{$order->total_price}}</span></h4>
                   </div>
               </div>
           
             </div>
         
          
        </div>
     </div>
  </div>

@endsection