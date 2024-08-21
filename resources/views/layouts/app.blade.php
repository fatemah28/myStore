<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>{{env('APP_NAME')}}</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="/client/assets/img/favicon.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('/client/assets/css/all.min.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="/client/assets/bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="/client/assets/css/owl.carousel.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="/client/assets/css/magnific-popup.css">
    <!-- animate css -->
    <link rel="stylesheet" href="/client/assets/css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="/client/assets/css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="/client/assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="/client/assets/css/responsive.css">

</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="{{route('home')}}">
                                <img src="/client/assets/img/logo.png" alt="">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu">
                            <ul>
                                <li class="current-list-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li><a href="{{ route('GetClientProducts') }}">Our products</a></li>
                                </li>
                                <li><a href="{{route('shop')}}">Shop</a></li>
                                @guest
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                @else
                                    <li><a href="{{ route('cart') }}">Your Cart</a></li>
                                @endguest
                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="{{ route('cart') }}"><i
                                                class="fas fa-shopping-cart"></i></a>
                                        <a class="mobile-hide search-bar-icon" href="#"><i
                                                class="fas fa-search"></i></a>
                                                @auth
                                        <a class="mobile-hide fa-sign-out-alt" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i
                                                class="fas fa-sign-out-alt"></i></a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                                @endauth
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>Search For:</h3>
                            <input type="text" placeholder="Keywords">
                            <button type="submit">Search <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search area -->
    @yield('content')

    <!-- footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">About us</h2>
                        <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">Get in Touch</h2>
                        <ul>
                            <li>34/8, East Hukupara, Gifirtok, Sadan.</li>
                            <li>support@fruitkha.com</li>
                            <li>+00 111 222 3333</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box pages">
                        <h2 class="widget-title">Pages</h2>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                            {{-- <li><a href="{{url('/about')}}">About</a></li> --}}
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                            @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @else
                                <li><a href="{{ route('cart') }}">Cart</a></li>
                            @endguest

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box subscribe">
                        <h2 class="widget-title">Subscribe</h2>
                        <p>Subscribe to our mailing list to get the latest updates.</p>
                        <form action="{{ route('home') }}">
                            <input type="email" placeholder="Email">
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end footer -->

    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; {{now()->year }} <a href="https://imransdesign.com/">{{env('APP_NAME')}}</a>, All Rights
                        Reserved.<br>
                       
                    </p>
                </div>
                <div class="col-lg-6 text-right col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->

    <!-- jquery -->
    <script src="/client/assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="/client/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- count down -->
    <script src="/client/assets/js/jquery.countdown.js"></script>
    <!-- isotope -->
    <script src="/client/assets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- waypoints -->
    <script src="/client/assets/js/waypoints.js"></script>
    <!-- owl carousel -->
    <script src="/client/assets/js/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="/client/assets/js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="/client/assets/js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="/client/assets/js/sticker.js"></script>
    <!-- main js -->
    <script src="/client/assets/js/main.js"></script>

</body>

</html>
