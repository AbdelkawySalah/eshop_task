@extends('front.layouts.front')
@section('title')
My WishList
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a>
            ||
            <a href="{{url('wishlist')}}">
                WishList
            </a>
        </h6>
    </div>
</div>
<div class="container my-5">
    <div class="card">
        <div class="card-body">

            @if($wishlist->count()>0)
                
                @foreach($wishlist as $item)
                <div class="row">
                    <div class="col-md-2 my-auto">
                        <img src="{{asset('admin/uploads/prods/'.$item->products->image)}}" style="height:70px;width:70px;" alt="" />
                    </div>
                    <div class="col-md-2 my-auto">
                        <h6>{{$item->products->name}}</h6>
                        <input type="hidden" id="prod_id" value="{{$item->prod_id}}" />
                    </div>
                    <div class="col-md-2 my-auto">
                        <h6>Price : {{$item->products->selling_price}}</h6>
                    </div>

                    <div class="col-md-2 my-auto">
                        <input type="hidden" id="prod_id">
                        @if($item->products->qty >= $item->prod_qty)
                        <label>Quantity</label>
                        <div class="input-group text-center mb-3" style="width:130px;">
                            <button class="input-group-text ChangeQuantity" id="decrement-btn">-</button>
                            <input type="text" name="quantity" id="qty-input" value="1" class="form-control" />
                            <button class="input-group-text ChangeQuantity" id="increment-btn">+</button>
                        </div>
                        @else
                        <h6>Out Of Stock</h6>
                        @endif
                    </div>
                    <div class="col-md-2 my-auto">
                        <button class="btn btn-success" id="addcart"><i class="fa fa-shopping-cart"></i>add to cart</button>
                    </div>
                    <div class="col-md-2 my-auto">
                        <button class="btn btn-danger remove-wishlist-item"><i class="fa fa-trash"></i>Remove</button>
                    </div>
                    
                </div>
                @endforeach

            @else
              <h2>There is No Product in your WishLists</h2>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
   <script>
     $(document).ready(function(){
       

        $("#addcart").click(function() {
            var prod_id=$('#prod_id').val();
            var product_qty=$('#qty-input').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });    
        $.ajax({
            method:"POST",
            url:"/add-to-cart",
            data:{
                'prod_id1':prod_id,
                'product_qty1':product_qty,
            },
            success:function (response)
            {
                // alert(response.status);
                swal(response.status);

            }

        });

        });
          
        
        $(".remove-wishlist-item").click(function() {
           
            var prod_id=$('#prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });    
        $.ajax({
            method:"POST",
            url:"/remove-from-wishlist",
            data:{
                'prod_id1':prod_id,
            },
            success:function (response)
            {
                window.location.reload();
                swal("",response.status,"success");

            }

        });

        });


        $('#increment-btn').click(function(e) {
            e.preventDefault();
            //    var inc_value=$(this).closest('.product_data').find("#qty-input").val();
            var inc_value = $("#qty-input").val();

            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value < 10) {
                value++;
                $('#qty-input').val(value);
            }
        });

        $('#decrement-btn').click(function(e) {
            e.preventDefault();
            var doc_value = $("#qty-input").val();
            //    var doc_value=$(this).closest('.product_data').find("#qty-input").val();

            var value = parseInt(doc_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                $("#qty-input").val(value);
            }
        });


    });
   </script>

@endsection