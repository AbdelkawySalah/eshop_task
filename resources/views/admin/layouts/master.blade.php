<!doctype html>
<html lang="en">
<head>
    @include('admin.layouts.head')
</head>

<body>
  @include('admin.layouts.navbar')
   
  <div class="container m-5 p-5">
     @yield('content')
   </div>
   
  @include('admin.layouts.footer_scripts')

</body>

</html>