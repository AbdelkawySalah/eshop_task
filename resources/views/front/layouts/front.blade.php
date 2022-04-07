<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--     csrf-token    -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!--     Fonts and icons     -->
  <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /> -->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/fonticons.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/font-awesome.min.css')}}" />
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
  <!-- CSS Files -->
  <!-- Styles -->
  <link href="{{asset('frontend/css/custom.css')}}" rel="stylesheet" />
  <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet" />

  <link href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet" />
  <link href="{{asset('frontend/css/owl.theme.default.min.css')}}" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


{{-- fontawsome --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital@0;1&display=swap" rel="stylesheet"> 
<style>
  a{
    text-decoration: none !important;
  }
</style>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    
     @include('front.layouts.inc.frontnavbar')
      <div class="content">
        @yield('content')
      </div>

  <!--  checkout   -->

  <script src="{{ asset('frontend/js/checkout.js')}} "></script>

  <!--   Core JS Files   -->
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}} "></script>
  <script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}} "></script>

  <!-- jquery-3.3.1.min.js -->
  <script src="{{ asset('frontend/js/owl.carousel.min')}} "></script>

  <!-- //sweet alert -->
  <!-- https://sweetalert.js.org/guides/ -->
  <script src="{{ asset('frontend/js/sweetalert.min.js')}} "></script>
  @if(session('status'))
  <script>
    //   swal(" {{session('status')}} ");
    swal({
      title: "Msg Add",
      text: "{{session('status')}}",
      icon: "success",
    });
  </script>
  @endif
  @if(session('del'))
  <script>
    //   swal(" {{session('status')}} ");
    swal({
      title: "Msg deleted",
      text: "{{session('status')}}",
      icon: "success",
    });
  </script>
  @endif
  @yield('scripts')

  @section('scripts')
   <script>
     $(document).ready(function(){
        loadcart();
        loadwishlist();

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });  

        function loadcart()
        {
            $.ajax({
                method:"GET",
                url:"/load-cart-data",
                success:function(response){
                    //alert(response.count)
                    $('.cart-count').html('');
                    $(".cart-count").html(response.count);

                }
            });
        }
  

        function loadwishlist()
        {
            $.ajax({
                method:"GET",
                url:"/load-wishlist-data",
                success:function(response){
                    //alert(response.count)
                    $('.wishlist-count').html('');
                    $(".wishlist-count").html(response.count);

                }
            });
        }
  
           
        });

   </script>

</body>

</html>