@extends('admin.layouts.master')

@section('title')
  Home
@endsection

@section('css')
@endsection

@section('content')
 <div class="d-flex justify-content-between mb-3">
  <h6>Manage Buyer</h6>
  <a href="{{route('admin.buyer.add')}}" class="btn btn-sm btn-success">Add Buyer</a>
 </div>
 <hr>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
   @foreach($users as $user)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->status==1?'Active':'Not Active'}}</td>
      <td>
         <a href="{{route('admin.changestatus',$user->id)}}" type="button" class="btn btn-sm btn-primary">Change Status </button> 
         
         <a href="{{route('admin.editbuyer',$user->id)}}" type="button" class="btn btn-sm btn-danger">Edit user</button> 

      </td>
    </tr>
   @endforeach
   
  </tbody>
</table>
@endsection


@section('scripts')
@endsection