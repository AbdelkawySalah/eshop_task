@extends('admin.layouts.master')

@section('title')
  Change Buyer / Status
@endsection


@section('content')
<div class="d-flex justify-content-between mb-3">
  <h6>Categories / Update </h6>
  <a href="{{route('admin.home')}}" class="btn btn-sm btn-success">Back</a>
 </div>
 @include('admin.layouts.errors')
 <div class="card">
     <div class="card-body">
         <form action="{{route('admin.buyerstatus.update')}}" method="POST" enctype="multipart/form-data">
           @csrf
            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name" value="{{$user->name}}" disabled></input>
                  <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}"></input>
                  </div>

                  <div class="col-md-6 mb-3">
                  <label for="">status</label>
                  <input type="checkbox" name="status" {{$user->status==1?'checked':''}}></input>
               </div>
              
             
               <div class="col-md-12">
                   <input type="submit" class="btn btn-primary" value="update status">
               </div>
              
             
            </div>
         </form>
     </div>
  </div>
@endsection


@section('scripts')
@endsection