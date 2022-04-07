<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('admin.home')}}">Users | </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('admin.cat.index')}}">Categoies |</a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('admin.product.index')}}">Products |</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('admin.orders.index')}}">Orders</a>
        </li>
       </ul>
         
          <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('admin.logout')}}">Logout</a>
        </li>
       </ul>
    </div>

   
  </div>
</nav>