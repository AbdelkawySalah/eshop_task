@extends('front.layouts.front')
@section('title')
My Cart
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a>
            ||
            <a href="{{url('cart')}}">
                Cart
            </a>
        </h6>
    </div>
</div>
<div class="container my-5">
    <div class="card shadow product_data">
       @if($cartitems->count()>0)

        <div class="card-body">
        @php $total=0; @endphp
            @foreach($cartitems as $item)
            <div class="row">
                <div class="col-md-2 my-auto">
                    <img src="{{asset('admin/uploads/prods/'.$item->products->image)}}" style="height:70px;width:70px;" alt="" />
                </div>
                <div class="col-md-3 my-auto">
                    <h6>{{$item->products->name}}</h6>
                    <input type="hidden" id="prod_id" value="{{$item->prod_id}}" />
                </div>
                <div class="col-md-2 my-auto">
                    <h6>Price : {{$item->products->selling_price}}</h6>
                </div>

                <div class="col-md-3 my-auto">
                    <input type="hidden" id="prod_id">
                    @if($item->products->qty >= $item->prod_qty)
                    <label>Quantity</label>
                    <div class="input-group text-center mb-3" style="width:130px;">
                        <button class="input-group-text ChangeQuantity" id="decrement-btn">-</button>
                        <input type="text" name="quantity" id="qty-input" value="{{$item->prod_qty}}" class="form-control" />
                        <button class="input-group-text ChangeQuantity" id="increment-btn">+</button>
                    </div>
                    @php $total += $item->products->selling_price * $item->prod_qty; @endphp
                     @else
                     <h6>Out Of Stock</h6>
                    @endif
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger" id="delete-cart-item"><i class="fa fa-trash"></i>Remove</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-footer">
             <h6>Total Price : LE {{$total}}
             <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proceed To CheckOut</a>
             </h6>
        </div>
      @else
      <div class="card-body text-center">
         <h2>Your<i class="fa fa-shopping-cart"></i>Cart is Empty</h2>
         <a href="{{url('/')}}" class="btn btn-outline-primary float-end">Continue Shopping</a>
      </div>
      @endif
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        //  delete item cart
        $("#delete-cart-item").click(function(e) {
            e.preventDefault();
            var prod_id=$("#prod_id").val();
            // alert(prod_id);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
             });   
            $.ajax({
            method:"POST",
            url:"delete-from-cart",
            data:{
                'prod_id1':prod_id,
            },
            success:function (response)
            {
                // alert(response.status);
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

        // ChangeTotalQuantityClass
        $('.ChangeQuantity').click(function(e) {
            e.preventDefault();
            var prod_id=$("#prod_id").val();
            // alert(prod_id);
            var qty=$("#qty-input").val();
            data1={
                'prod_id1':prod_id,
                'prod_qty1':qty,
            }
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
             });   
            $.ajax({
            method:"POST",
            url:"update-cart",
            data:data1,
            success:function (response)
            {
                window.location.reload();
            }

        });
        });

    });
</script>

@endsection