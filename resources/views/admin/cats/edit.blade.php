@extends('admin.layouts.master')

@section('title')
  update_Categories / {{$category->name}}
@endsection


@section('content')
<div class="d-flex justify-content-between mb-3">
  <h6>Categories / Update </h6>
  <a href="{{route('admin.cat.index')}}" class="btn btn-sm btn-success">Back</a>
 </div>
 @include('admin.layouts.errors')
 <div class="card">
     <div class="card-body">
         <form action="{{route('admin.cat.update')}}" method="POST" enctype="multipart/form-data">
           @csrf
            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name" value="{{$category->name}}"></input>
                  <input type="hidden" class="form-control" name="cat_id" value="{{$category->id}}"></input>

               </div>
               <div class="col-md-6 mb-3">
                  <label for="">Slug</label>
                  <input type="text" class="form-control" name="slug" value="{{$category->slug}}"></input>
               </div>
               <div class="col-md-12 mb-3">
                   <textarea name="description"  rows="3" class="form-control">{{$category->description}}</textarea>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">status</label>
                  <input type="checkbox" name="status" {{$category->status==1?'checked':''}}></input>
               </div>
              
               @if($category->image)
                   <img src="{{asset('admin/uploads/cats/'.$category->image)}}" class="cate-image"  width="50px" alt="not found">
               @endif
               <div class="col-md-12">
                   <input type="file" name="image" class="form-control"  value="$category->image">
               </div>
               <div class="col-md-12">
                   <input type="submit" class="btn btn-primary" value="update">
               </div>
            </div>
         </form>
     </div>
  </div>
@endsection


@section('scripts')
@endsection