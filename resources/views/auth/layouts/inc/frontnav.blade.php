<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">E-Commerce</a>
        <div class="search-bar" style="width: 50%">
            <form action="{{url('/search-product')}}" method="POST">
                @csrf
                <div class="input-group mb-2">
                    <input type="search" class="form-control" placeholder="Search" name="product_name" aria-label="Username"
                        aria-describedby="basic-addon1" id="tags">
                    <button class="input-group-text" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/categories') }}">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('cart') }}">Cart <i
                            class="fa-solid fa-cart-shopping"></i><span class="badge badge-pill cart-count">0</span></a>

                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('wishlist') }}">Wishlist <i
                            class="fa-solid fa-heart"></i><span class="badge badge-pill wish-count">0</span></a>

                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                     @if(Auth::user()->profile)
                     <img src="{{url(Auth::user()->profile)}}" class="" alt="..." width="40px" height="40px" style="border-radius: 20px">
                     @endif
                    {{-- <source srcset="..." type="image/svg+xml"> --}}
                    <div class="dropdown">
                        <li class="dropdown-toggle nav-link" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </li>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile">Profile <i class="fa-solid fa-user"></i></a></li>
                            <li><a class="dropdown-item" href="my-orders">My Orders  <i class="fa-solid fa-list"></i></a></li>
                            <li><a class="dropdown-item" href="logout">Logout   <i class="fa-solid fa-right-from-bracket"></i></a></li>
                        </ul>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>
{{-- <a class="nav-link" href="#">Features</a>
  <a class="nav-link" href="{{url('/login')}}">Login</a>
  <a class="nav-link" href="{{url('/register')}}">Register</a> --}}
