<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <img src="{{ asset('images/ecommerce_logo.png') }}" class="logo-image">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="collapse navbar-collapse" type="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            Shopping Cart
                            <span class="badge badge-light">
                                {{-- Shows the number of items in the cart --}}
                                {{-- @if (session()->has('cart'))
                                    {{ sizeof(session()->get('cart')) }}
                                @endif --}}
                                @auth
                                    {{-- Cart is defined as an alias in app.php in config folder --}}
                                    @php
                                        $cart = Cart::where('user_id', Auth::id())->first();
                                    @endphp

                                    {{ $cart->total_items }}
                                @endauth
                            </span>
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest

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

                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
