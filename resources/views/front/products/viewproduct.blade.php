@extends('front.layouts.front')
@section('title',$product->name)


@section('content')
  <div class="py-3 mb-4 shadow-sm bg-warning border-top">
     <div class="container">
         <h6 class="mb-0">Collections /  {{$product->cat->name}} / {{$product->name}}</h6>
     </div>
  </div>
   <div class="container">
      <div class="card shadow product_data">
         <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{asset('admin/uploads/prods/'.$product->image)}}" class="w-100" alt="" />
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{$product->name}}
                            @if($product->trending =='1')
                            <label style="font-size:16px;" class="float-end badge bg-danger trending _tag">Trending</label>
                            @endif
                         </h2>
                         <hr>
                            <label  class="fw-bold">Selling Price : <s>Rs {{$product->selling_price}}</s></label>
                            <p>
                              {!! $product->small_description !!}
                            </p>
                        <hr>
                       @if($product->qty>0)
                           <label class="badge bg-success">In Stock</label>
                       @else
                       <label class="badge bg-danger">out of Stock</label>
                       @endif
                       <div class="row mt-2">
                           <div class="col-md-2">
                               <input type="hidden" value="{{$product->id}}" id="prod_id">
                                <label>Quantity</label>
                                <div class="input-group text-center mb-3">
                                   <button  id="decrement-btn">-</button>
                                    <input type="text" name="quantity" id="qty-input" value="1" class="form-control" />
                                    <button  id="increment-btn">+</button>
                                </div>
                           </div>
                           <div class="col-md-10">
                              <br/>
                              @if($product->qty>0)
                              <button type="button" id="addcart" class="btn btn-primary me-3 float-start">Add To Cart  <i class="fa fa-shopping-cart"></i></button>
                              @endif
                              <button type="button"  class="btn btn-success me-3 float-start Addtowishlist">Add To WishList <i class="fa fa-heart"></i></button>
                            </div>
                       </div>
                    </div>
                </div>
         </div>
      </div>
   </div>
@endsection

@section('scripts')
   <script>
     $(document).ready(function(){
        loadwishlist();
    
      //view conut cart
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });  

        function loadwishlist()
        {
            $.ajax({
                method:"GET",
                url:"/load-wishlist-data",
                success:function(response){
                    // alert(response.count)
                    $('.wishlist-count').html('');
                    $(".wishlist-count").html(response.count);

                }
            });
        }


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
                loadcart();

            }

        });

        });
          
        $('#increment-btn').click(function (e)
           {
               e.preventDefault();
               var inc_value=$("#qty-input").val();
               var value=parseInt(inc_value,10);
               value = isNaN(value)? 0: value;
               if(value<10)
               {
                   value++;
                   $('#qty-input').val(value);
               }
           });

           $('#decrement-btn').click(function (e) 
           {
               e.preventDefault();
               var doc_value=$("#qty-input").val();
               var value=parseInt(doc_value,10);
               value=isNaN(value)?0:value;
               if(value>1)
               {
                   value--;
                   $("#qty-input").val(value);
               }
           });


           
           $('.Addtowishlist').click(function (e) 
           {
            loadwishlist();
            var prod_id=$('#prod_id').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
            });    
            $.ajax({
                method:"POST",
                url:"/add-to-wishlist",
                data:{
                    'prod_id1':prod_id,
                },
                success:function (response)
                {
                    // alert(response.status);
                    swal(response.status);

                }
            });

        });

    });
   </script>

@endsection