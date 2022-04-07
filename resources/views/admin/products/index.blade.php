@extends('admin.layouts.master')

@section('title')
  products
@endsection

@section('css')
  <style>
     img{
         width: 50px;
         height: 50px;
     }
  </style>
@endsection

@section('content')
 <div class="d-flex justify-content-between mb-3">
  <h6>products</h6>
  <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-success">Add</a>
 </div>
 
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">small_desc</th>
      <th scope="col">price</th>
      <th scope="col">Photo</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
   @foreach($products as $product)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$product->name}}</td>
      <td>
        {{$product->cat->name}}  
      </td>
      <td>{{$product->small_description}}</td>
      <td>{{$product->selling_price}}</td>
      <td><img src="{{asset('admin/uploads/prods/'.$product->image)}}"  alt="{{$product->img}}" title="{{$product->img}}" /></td>

      <td>
         <a href="{{route('admin.product.edit',$product->id)}}" type="button" class="btn btn-sm btn-primary">Edit</button> 
         <a href="{{route('admin.product.delete',$product->id)}}" type="button" class="btn btn-sm btn-danger">Delete</button>
      </td>
    </tr>
   @endforeach

  </tbody>

</table>
@endsection


@section('scripts')
@endsection