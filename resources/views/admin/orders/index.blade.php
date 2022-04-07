@extends('admin.layouts.master')
@section('title','all Orders')
@section('content')
  <div class="container py-5">
     <div class="row">
        <div class="col-md-12">
             <div class="card-header">
                 <h4>All_Orders</h4>
             </div>
             <div class="card-body">
             <table class="table table-borderd">
               <thead>
                 <tr>
                   <th>buyer</th>
                    <th>Tracking Number</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                 </tr>
               </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                      <td>{{$order->users->name}}</td>
                      <td>{{$order->tracking_no}}</td>
                      <td>{{$order->total_price}}</td>
                      <td>{{$order->status==0?'Pending':'completed'}}</td>
                      <td>
                         <a href="{{route('admin.orders.view',$order->id)}}" class="btn btn-primary">View</a>
                        @if($order->status==0)
                         <a href="{{route('admin.orders.update_status',$order->id)}}" class="btn btn-primary" >Change Order status</a>
                          @else
                          <a href="{{route('admin.orders.update_status',$order->id)}}" class="btn btn-primary" style="pointer-events:none" >Change Order status</a>

                         @endif
                      </td>
                     
                    </tr>
                @endforeach
                </tbody>
           </table>
             </div>
         
          


@endsection