@extends('front.layouts.front')
@section('title')
   Ecommerce
@endsection

@section('content')
    <div class="py-5">
       <div class="container">
          <div class="row">
             <div class="col-md-12">
             <h2>Shopping</h2>
             <hr>
                <div class="row">
                    @foreach($category as $cate)
                    <div class="col-md-4 mb-3">
                      <div class="card">
                           <a href="{{route('front.showproducts',$cate->id)}}">
                              <img src="{{asset('admin/uploads/cats/'.$cate->image)}}" class="cate-image"  alt="image">
                              <div class="card-body">
                                 <h5>{{$cate->name}}</h5>
                                 <p>{{$cate->meta_descrip}}</p>
                              </div>
                           </a>
                      </div>
                  </div>
                    @endforeach
                </div>
             </div>
          </div>
       </div>
    </div>
 @endsection
