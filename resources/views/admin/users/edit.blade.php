@extends('admin.layouts.master')

@section('title')
  edit_buyer || {{$user->name}}
@endsection


@section('content')
<div class="d-flex justify-content-between mb-3">
  <h6>add / buyer</h6>
  <a href="{{route('admin.home')}}" class="btn btn-sm btn-success">Back</a>
 </div>
 @include('admin.layouts.errors')
 <div class="card">
     <div class="card-body">
         <form action="{{route('admin.buyer.update')}}" method="POST">
           @csrf
            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name" value="{{$user->name}}"></input>
                  <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}"></input>

               </div>
               <div class="col-md-6 mb-3">
                  <label for="">email</label>
                  <input type="text" class="form-control" name="email" value="{{$user->email}}"></input>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">password</label>
                  <input type="password" class="form-control" name="password" value="{{$user->password}}"></input>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">status</label>
                  <input type="checkbox" name="status" {{$user->status==1?'checked':''}}></input>
               </div>
               <div class="col-md-12">
                   <br/>
                   <input type="submit" class="btn btn-primary" Value="update_buyer">
               </div>
            </div>
         </form>
     </div>
  </div>
@endsection


@section('scripts')
@endsection