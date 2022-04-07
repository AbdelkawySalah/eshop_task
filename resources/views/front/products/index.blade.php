@extends('front.layouts.front')
@section('title')
{{$category->name}}
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
     <div class="container">
         <h6 class="mb-0">Collections / {{$category->name}}</h6>
     </div>
  </div>
<div class="py-5">
       <div class="container">
          <div class="row">
             <div class="col-md-12">
             <h2>{{$category->name}}</h2>
                <div class="row">
                    @foreach($products as $products)
                    <div class="col-md-3 mb-3">
                      <div class="card">
                        <a href="{{route('front.viewproduct',$products->id)}}">
                              <img src="{{asset('admin/uploads/prods/'.$products->image)}}" class="w-100" alt="image">
                              <div class="card-body">
                              <h5>{{$products->name}}</h5>
                                 <span class="float-start">{{$products->selling_price}} LE</small>

                              </div>
                           </a>
                      </div>
                  </div>
                    @endforeach
                </div>
             </div>
          </div>
       </div>
@endsection