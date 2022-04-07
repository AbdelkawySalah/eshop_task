<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{route('front.homepage')}}">E-Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
       
        @if(auth()->guard('web')->check())
        <li class="nav-item">
          <a class="nav-link" href="{{url('cart')}}">Cart
           <span class="badge badge-pill bg-primary cart-count">-</span>
          </a>
        </li>

        <li class="nav-item {{ Request::is('wishlist')?'active':''}}">
          <a class="nav-link" href="{{url('wishlist')}}">Wishlist
          <span class="badge badge-pill bg-success wishlist-count">1</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{url('my-orders')}}">My Orders ||</a>
        </li>
        <li class="nav-item">
          <a class="nav-link">Welecome >> {{auth()->guard('web')->user()->name}}</a>

        </li>
        <li class="nav-item">
          <a class="nav-link"  href="{{route('user.logout')}}">logout</a>
          
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{route('user.login')}}">Login</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
