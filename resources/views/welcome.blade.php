@extends('layouts.layout')
@section('content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="assets/img/logo.png" alt="">
                <h1 class="sitename">SiPro</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    @if (Auth::check())
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link"
                                    style="padding: 0; border: none; background: none;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/forgot-password') }}">Forgot Password</a></li>
                    @endif
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            @if (Auth::check())
                <a class="btn-getstarted flex-md-shrink-0" href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a class="btn-getstarted flex-md-shrink-0" href="{{ url('/register') }}">Register</a>
            @endif

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 data-aos="fade-up">SiPRO: Inovasi Media Pembelajaran Digital pada Materi Kombinatorika</h1>
                        <p data-aos="fade-up" data-aos-delay="100">dengan Penyesuaian Gaya Belajar Berbasis AI dan Etnomatematika Daerah Malang</p>
                        {{-- <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
              <a href="#about" class="btn-get-started">Get Started <i class="bi bi-arrow-right"></i></a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div> --}}
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                        <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->


        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>                
                
@endsection
