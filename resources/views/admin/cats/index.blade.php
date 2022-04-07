@extends('admin.layouts.master')

@section('title')
  Categories
@endsection

@section('css')
@endsection

@section('content')
 <div class="d-flex justify-content-between mb-3">
  <h6>Categories</h6>
  <a href="{{route('admin.cat.create')}}" class="btn btn-sm btn-success">Add</a>
 </div>
 <hr>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
   @foreach($cats as $cat)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$cat->name}}</td>
      <td>
         <a href="{{route('admin.cat.edit',$cat->id)}}" type="button" class="btn btn-sm btn-primary">Edit</button> 
         <a href="{{route('admin.cat.delete',$cat->id)}}" type="button" class="btn btn-sm btn-danger">Delete</button>
      </td>
    </tr>
   @endforeach
   
  </tbody>
</table>
@endsection


@section('scripts')
@endsection