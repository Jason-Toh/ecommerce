<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/ecommerce_logo.png') }}" class="logo-image">
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
