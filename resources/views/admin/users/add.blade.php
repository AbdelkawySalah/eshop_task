@extends('admin.layouts.master')

@section('title')
  Add_buyer
@endsection


@section('content')
<div class="d-flex justify-content-between mb-3">
  <h6>add / buyer</h6>
  <a href="{{route('admin.home')}}" class="btn btn-sm btn-success">Back</a>
 </div>
 @include('admin.layouts.errors')
 <div class="card">
     <div class="card-body">
         <form action="{{route('admin.buyer.store')}}" method="POST" enctype="multipart/form-data">
           @csrf
            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name"></input>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">email</label>
                  <input type="text" class="form-control" name="email"></input>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">password</label>
                  <input type="text" class="form-control" name="password"></input>
               </div>
            
               <div class="col-md-12">
                   <br/>
                   <input type="submit" class="btn btn-primary" Value="add_buyer">
               </div>
            </div>
         </form>
     </div>
  </div>
@endsection


@section('scripts')
@endsection