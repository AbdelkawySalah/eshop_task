@extends('admin.layouts.master')

@section('title')
  Add_Course
@endsection


@section('content')
<div class="d-flex justify-content-between mb-3">
  <h6>Products / Add New</h6>
  <a href="{{route('admin.product.index')}}" class="btn btn-sm btn-success">Back</a>
 </div>
 <hr/>
 @include('admin.layouts.errors')
 <div class="card">
     <div class="card-body">
         <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
           @csrf
            <div class="row">
               <div class="col-md-12 mb-3">
                  <select class="form-select" name="cate_id">
                     <option value="">choose category</option>
                     @foreach($cats as $category)
                       <option value="{{$category->id}}">{{$category->name}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name"></input>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">Slug</label>
                  <input type="text" class="form-control" name="slug"></input>
               </div>
               <div class="col-md-12 mb-3">
                  <label for="">Small Description</label>
                   <textarea name="small_description"  rows="3" class="form-control"></textarea>
               </div>
               <div class="col-md-12 mb-3">
                   <label for="">Description</label>
                   <textarea name="description"  rows="3" class="form-control"></textarea>
               </div>
               <div class="col-md-6 mb-3">
                   <label for="">Original Price</label>
                  <input type="number" class="form-control" name="original_price" value="">
               </div>
               <div class="col-md-6 mb-3">
                   <label for="">Selling Price</label>
                  <input type="number" class="form-control" name="selling_price" value="">
               </div>
               <div class="col-md-6 mb-3">
                   <label for="">Tax</label>
                  <input type="number" class="form-control" name="tax">
               </div>
               <div class="col-md-6 mb-3">
                   <label for="">Quantity</label>
                  <input type="number" class="form-control" name="qty">
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">status</label>
                  <input type="checkbox" name="status"></input>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">trending</label>
                  <input type="checkbox" name="trending"></input>
               </div>
               <div class="col-md-12">
                   <input type="file" name="image" class="form-control" class="image_style">
               </div>
               <div class="col-md-12">
                   <input type="submit" class="btn btn-primary" value="add_product">
               </div>
            </div>
         </form>
     </div>
  </div>

@endsection


@section('scripts')
@endsection