<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="collapse navbar-collapse" type="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders') }}">Orders</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}">
                            <i class="fa fa-shopping-cart"></i>
                            Shopping Cart
                            <span class="badge badge-light">
                                {{-- Shows the number of items in the cart --}}
                                @if (session()->has('cart'))
                                    {{ sizeof(session()->get('cart')) }}
                                @endif
                            </span>
                        </a>
                    </li>
                    {{-- @guest is displayed only for unauthorized users
                        https://stackoverflow.com/questions/64075908/laravel-7-blade-view-guest-and-authuser-problem
                        https://stackoverflow.com/questions/51693904/laravel-double-auth-and-guest-statement --}}
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @endguest

                    {{-- Authorized users 

                        TODO: Fixed authorized users able to access login page --}}
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                {{-- <a class="dropdown-item" href="#">Another Action</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">Something else here</a> --}}
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
            {{-- https://getbootstrap.com/docs/4.0/utilities/spacing/ --}}
            {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
        </div>
    </nav>
</header>
