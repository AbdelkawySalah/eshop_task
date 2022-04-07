@extends('front.layouts.front')
@section('title')
Checkout
@endsection

@section('content')
<div class="conatiner mt-5">
    <form action="{{url('place-order')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input type="text" class="form-control firstname" placeholder="Enter First Name" name="fname" />
                                <span id="fname_error" style="color:red"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input type="text" class="form-control lastname" placeholder="Enter Last Name" name="lname" />
                                <span id="lname_error" style="color:red"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Email</label>
                                <input type="text" class="form-control email" placeholder="Enter Email" name="email" />
                                <span id="email_error" style="color:red"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Phone Number</label>
                                <input type="text" class="form-control phone" placeholder="Enter PhoneNumber" name="phone" />
                                <span id="phone_error" style="color:red"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Address 1</label>
                                <input type="text" class="form-control address1" placeholder="Enter Address 1" name="address1" />
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Address 2</label>
                                <input type="text" class="form-control address2" placeholder="Enter Address 2" name="address2" />
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>City</label>
                                <input type="text" class="form-control city" placeholder="Enter City" name="city" />
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>State</label>
                                <input type="text" class="form-control state" placeholder="Enter State" name="state" />
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Country</label>
                                <input type="text" class="form-control country" placeholder="Enter Country" name="country" />
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Pin Code</label>
                                <input type="text" class="form-control pincode" placeholder="Enter PinCode" name="pincode" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Order Deatils</h6>
                        <hr>
                        @if($cartcheck->count()>0)
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartcheck as $cart)
                                <tr>
                                    <td>{{$cart->products->name}}</td>
                                    <td>{{$cart->prod_qty}}</td>
                                    <td>{{$cart->products->selling_price}}</td>

                                </tr>

                                @endforeach

                            </tbody>
                        </table>
              
                        <hr>
                        <button id="order_btn" type="submit" class="btn btn-success w-100">Place Order |COD</button>
                        <button id="pay_btn" type="button" class="btn btn-primary w-100 mt-3">Pay </button>

                        @else
                        <div class="card-body text-center">
                            <h2>No Product in The Cart</h2>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#pay_btn").click(function() {
            var firstname = $('.firstname').val();
            var lastname = $('.lastname').val();
            var email = $('.email').val();
            var phone = $('.phone').val();
            var address1 = $('.address1').val();
            var address2 = $('.address2').val();
            var city = $('.city').val();
            var state = $('.state').val();
            var country = $('.country').val();
            var pincode = $('.pincode').val();

            if (!firstname) {
                $('#fname_error').html('firstname is required');
                $('.firstname').select();
            } else {
                $('#fname_error').html('');
            }

            if (!lastname) {
                $('#lname_error').html('lastname is required');
                $('.lastname').select();
            } else {
                $('#lname_error').html('');
            }


            if (!email) {
                $('#email_error').html('email is required');
                $('.email').select();
            } else {
                $('#email_error').html('');
            }


            if (!phone) {
                $('#phone_error').html('phone is required');
                $('.phone').select();
            } else {
                $('#phone_error').html('');
            }

            //go to pay
            if (firstname != '' || lastname != '' || email != '', phone != '') {
                var data = {
                    'firstname': firstname,
                    'lastname': lastname,
                    'email': email,
                    'phone': phone,
                    'address1': address1,
                    'address2': address2,
                    'city': city,
                }
                $.ajax({
                    method: "POST",
                    url: '/procceed-to-pay',
                    data: data,
                    success: function(response) {
                        alert(response.total_price)
                        
                    }

                });
            } else {
                return false;
            }

        });


        $("#order_btn").click(function() {
            var firstname = $('.firstname').val();
            var lastname = $('.lastname').val();
            var email = $('.email').val();
            var phone = $('.phone').val();
            var address1 = $('.address1').val();
            var address2 = $('.address2').val();
            var city = $('.city').val();
            var state = $('.state').val();
            var country = $('.country').val();
            var pincode = $('.pincode').val();

            if (!firstname) {
                $('#fname_error').html('firstname is required');
                $('.firstname').select();
            } else {
                $('#fname_error').html('');
            }

            if (!lastname) {
                $('#lname_error').html('lastname is required');
                $('.lastname').select();
            } else {
                $('#lname_error').html('');
            }


            if (!email) {
                $('#email_error').html('email is required');
                $('.email').select();
            } else {
                $('#email_error').html('');
            }


            if (!phone) {
                $('#phone_error').html('phone is required');
                $('.phone').select();
            } else {
                $('#phone_error').html('');
            }

          

        });


    });
</script>
@endsection