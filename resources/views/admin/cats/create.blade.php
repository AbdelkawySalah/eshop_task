@extends('admin.layouts.master')

@section('title')
  Add_Categories
@endsection


@section('content')
<div class="d-flex justify-content-between mb-3">
  <h6>Categories / Add New</h6>
  <a href="{{route('admin.cat.index')}}" class="btn btn-sm btn-success">Back</a>
 </div>
 @include('admin.layouts.errors')
 <div class="card">
     <div class="card-body">
         <form action="{{route('admin.cat.store')}}" method="POST" enctype="multipart/form-data">
           @csrf
            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name"></input>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">Slug</label>
                  <input type="text" class="form-control" name="slug"></input>
               </div>
               <div class="col-md-12 mb-3">
                   <textarea name="description"  rows="3" class="form-control"></textarea>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">status</label>
                  <input type="checkbox" name="status"></input>
               </div>
               <div class="col-md-12">
                   <input type="file" name="image" class="form-control" class="image_style">
               </div>
               <div class="col-md-12">
                   <br/>
                   <input type="submit" class="btn btn-primary" Value="add_cat">
               </div>
            </div>
         </form>
     </div>
  </div>
@endsection


@section('scripts')
@endsection