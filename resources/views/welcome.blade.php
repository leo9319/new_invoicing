<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>MyAura | Home</title>
    <meta charset="UTF-8">
    <meta name="description" content="SolMusic HTML Template">
    <meta name="keywords" content="music, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon" />

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" />

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/style-template.css') }}" />

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header section -->
    <header class="header-section clearfix">
        <a href="index.html" class="site-logo">
            <img src="img/logo.png" alt="">
        </a>
        <div class="header-right">            
            <div class="user-panel">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}" class="login">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="login">Login</a>

                            @if (Route::has('register'))
                                <span>|</span>
                                <a href="" class="register">Register as a Reseller</a>
                            @endif
                        @endauth
                    </div>
                @endif
{{--                 <a href="" class="login">Login</a>
                <span>|</span>
                <a href="" class="register">Register as a Reseller</a> --}}
            </div>
        </div>
        <ul class="main-menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Pages</a>
                <ul class="sub-menu">
                    <li><a href="category.html">Category</a></li>
                    <li><a href="playlist.html">Playlist</a></li>
                    <li><a href="artist.html">Artist</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </li>
            <li><a href="blog.html">News</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </header>
    <!-- Header section end -->

    <!-- Hero section -->
    <section class="hero-section">
        <div class="hero-slider owl-carousel">
            <div class="hs-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6" style="margin-top: 250px">
                            <h2>Welcome to <span>My Aura</span></h2>
                            {{-- <p></p> --}}
                            {{-- <a href="#" class="site-btn">Become a reseller</a> --}}
                        </div>
                        <div class="col-lg-6">
                            <div class="hr-img">
                                <img src="{{ asset('images/home-side.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero section end -->

    <!-- Footer section -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7 order-lg-2">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="footer-widget">
                                <h2>About us</h2>
                                <ul>
                                    <li><a href="">Our Story</a></li>
                                    <li><a href="">Sol Music Blog</a></li>
                                    <li><a href="">History</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="footer-widget">
                                <h2>Products</h2>
                                <ul>
                                    <li><a href="">Music</a></li>
                                    <li><a href="">Subscription</a></li>
                                    <li><a href="">Custom Music</a></li>
                                    <li><a href="">Footage</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="footer-widget">
                                <h2>Playlists</h2>
                                <ul>
                                    <li><a href="">Newsletter</a></li>
                                    <li><a href="">Careers</a></li>
                                    <li><a href="">Press</a></li>
                                    <li><a href="">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 order-lg-1">
                    <img src="img/logo.png" alt="">
                    <div class="copyright">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <div class="social-links">
                        <a href=""><i class="fa fa-instagram"></i></a>
                        <a href=""><i class="fa fa-pinterest"></i></a>
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer section end -->

    <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/main-template.js') }}"></script>

</body>

</html>