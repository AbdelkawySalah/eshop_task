@extends('admin.layouts.master')

@section('title')
  edit_Products > {{$product->name}}
@endsection


@section('content')
<div class="d-flex justify-content-between mb-3">
  <h6>Products / Edit </h6>
  <a href="{{route('admin.product.index')}}" class="btn btn-sm btn-success">Back</a>
 </div>
 <hr/>
 @include('admin.layouts.errors')
 <div class="card">
     <div class="card-body">
     <form action="{{route('admin.product.update')}}" method="POST" enctype="multipart/form-data">
           @csrf
            <div class="row">
               <div class="col-md-12 mb-3">
                  <select class="form-select" name="cate_id">
                     <option value="">choose category</option>


                     @foreach($cats as $category)
                       <option value="{{$category->id}}" {{$category->id==$product->cate_id?'selected':''}}>{{$category->name}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name" value="{{$product->name}}"></input>
                  <input type="hidden" class="form-control" name="prod_id" value="{{$product->id}}"></input>

               </div>
               <div class="col-md-6 mb-3">
                  <label for="">Slug</label>
                  <input type="text" class="form-control" name="slug" value="{{$product->slug}}"></input>
               </div>
               <div class="col-md-12 mb-3">
                  <label for="">Small Description</label>
                   <textarea name="small_description"  rows="3" class="form-control">{{$product->small_description}}</textarea>
               </div>
               <div class="col-md-12 mb-3">
                   <label for="">Description</label>
                   <textarea name="description"  rows="3" class="form-control">{{$product->description}}</textarea>
               </div>
               <div class="col-md-6 mb-3">
                   <label for="">Original Price</label>
                  <input type="number" class="form-control" name="original_price" value="{{$product->original_price}}">
               </div>
               <div class="col-md-6 mb-3">
                   <label for="">Selling Price</label>
                  <input type="number" class="form-control" name="selling_price" value="{{$product->selling_price}}">
               </div>
               <div class="col-md-6 mb-3">
                   <label for="">Tax</label>
                  <input type="number" class="form-control" name="tax" value="{{$product->tax}}">
               </div>
               <div class="col-md-6 mb-3">
                   <label for="">Quantity</label>
                  <input type="number" class="form-control" name="qty" value="{{$product->qty}}">
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">status</label>
                  <input type="checkbox" name="status" {{$product->status=="1"?'checked':''}}></input>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">trending</label>
                  <input type="checkbox" name="trending" {{$product->trending=="1"?'checked':''}}></input>
               </div>
             
               @if($product->image)
                 <img src="{{asset('admin/uploads/prods/'.$product->image)}}" class="cate-image" alt="">
               @endif
               <div class="col-md-12">
                   <input type="file" name="image" class="form-control">
               </div>
               <div class="col-md-12">
                   <input type="submit" class="btn btn-primary">
               </div>
            </div>
         </form>
     </div>
  </div>
@endsection


@section('scripts')
@endsection