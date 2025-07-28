@extends('layouts.layout')
@section('content')
    <div>
        <nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-24">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-black text-lg font-semibold">
                            <img src="/assets/img/homepage/logo-navbar.png" alt="" style="height:60px;">
                        </a>
                    </div>
                    <div class="hidden md:flex space-x-6">
                        <a href="#" class="text-black nav-link font-bold">Beranda</a>
                        <a href="#tentang" class="text-black nav-link font-bold">Tentang Kami</a>
                        <a href="#fitur-unggulan" class="text-black nav-link font-bold">Fitur Unggulan</a>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        @if (Auth::check())
                            <a href="{{ route('dashboard') }}" class="text-black">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-black">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="bg-[#663F24] text-white px-6 py-3 rounded-xl hover:bg-[#3d2616] transition">Masuk</a>
                        @endif
                    </div>
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="text-black focus:outline-none">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div id="mobile-menu" class="md:hidden fixed top-0 left-0 w-full bg-white shadow-lg z-40 hidden">
                <div class="px-4 pt-4 pb-2 flex justify-between items-center">
                    <a href="{{ url('/') }}">
                        <img src="/assets/img/homepage/logo-navbar.png" alt="" style="height:40px;">
                    </a>
                    <button id="mobile-menu-close" class="text-black focus:outline-none">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="px-4 pb-4 space-y-4">
                    <a href="#" class="block text-black font-bold">Beranda</a>
                    <a href="#tentang" class="block text-black font-bold">Tentang Kami</a>
                    <a href="#fitur-unggulan" class="block text-black font-bold">Fitur Unggulan</a>
                    @if (Auth::check())
                        <a href="{{ route('dashboard') }}" class="block text-black">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block text-black w-full text-left">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="block bg-[#663F24] text-white px-6 py-3 rounded-xl hover:bg-[#3d2616] transition">Masuk</a>
                    @endif
                </div>
            </div>
            <script>
                const menuButton = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');
                const closeButton = document.getElementById('mobile-menu-close');
                const navbar = document.getElementById('navbar');

                menuButton.addEventListener('click', () => {
                    mobileMenu.classList.remove('hidden');
                });

                closeButton.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });

                window.addEventListener('scroll', () => {
                    if (window.scrollY > 10) {
                        navbar.classList.add('bg-white', 'shadow-md');
                    } else {
                        navbar.classList.remove('bg-white', 'shadow-md');
                    }
                });
            </script>
        </nav>

        {{-- Beranda --}}
        <div class="flex flex-col md:flex-row items-center justify-between rounded-2xl mt-32 md:px-16 px-10 overflow-hidden"
            id="beranda">
            <div class="md:w-1/2 w-full mb-8 md:mb-0">
                <button class="bg-[#663F24] text-white font-bold px-6 py-3 rounded-full mb-4 text-4xl pointer-events-none">
                    SiPRO
                </button>
                <h1 class="text-3xl md:text-5xl font-extrabold text-[#663F24] mb-4">Inovasi Media Pembelajaran Digital pada
                    Materi Kombinatorika</h1>
                <p class="text-lg md:text-xl text-gray-700 mb-6">
                    Dengan Penyesuaian Gaya Belajar Berbasis AI dan Etnomatematika Daerah Malang
                </p>
                <a href="{{ route('login') }}"
                    class="inline-block bg-[#663F24] text-white px-8 py-3 rounded-xl hover:bg-[#3d2616] transition font-semibold">
                    Masuk
                </a>
            </div>
            <div class="hidden md:w-1/2 w-full md:flex justify-center">
                <img src="/assets/img/homepage/topeng.png" alt="Banner EduCourse"
                    class="w-full max-w-md rounded-xl object-cover">
            </div>
        </div>
    </div>

    {{-- Tentang Kami --}}
    <div class="pt-10" id="tentang">
        <h1 class="text-3xl md:text-5xl font-extrabold text-black text-center mt-20">
            Belajar yang Personal, Kontekstual, dan Bermakna
        </h1>
    </div>
    <div class="flex flex-col md:flex-row items-center justify-center max-w-5xl mx-auto mt-16 px-4 pb-10 md:px-0">
        <div class="md:w-1/2 w-full flex justify-center mb-8 md:mb-0">
            <img src="/assets/img/homepage/logo.png" alt="Tentang Kami" class="w-72 md:w-96 rounded-xl object-cover">
        </div>
        <div class="md:w-1/2 w-full md:pl-12">
            <p class="text-black text-lg md:text-xl leading-relaxed">
                SiPRO adalah media pembelajaran digital yang memadukan <span class="font-bold">teknologi AI</span> dan
                <span class="font-bold">budaya lokal Malang</span> untuk
                mengajarkan materi kombinatorika secara adaptif dan kontekstual.
            </p>
            <p class="text-black text-lg md:text-xl leading-relaxed mt-4">
                Kami menghadirkan pengalaman belajar yang <span class="font-bold">personal</span>, <span
                    class="font-bold">menyenangkan</span>, dan <span class="font-bold">relevan</span> dengan kehidupan
                siswa.
            </p>
        </div>
    </div>

    {{-- Fitur Unggulan --}}
    <div class="pt-10" id="fitur-unggulan">
        <h1 class="text-3xl md:text-5xl font-extrabold text-black text-center mt-20">
            Fitur Unggulan SiPRO
        </h1>
    </div>
    <div class="max-w-6xl mx-auto px-4 py-16 space-y-8">
        <!-- Baris Pertama: 3 Card -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 place-items-center">
            <!-- Card 1 -->
            <div
                class="bg-[#5C2C06] text-white p-6 rounded-2xl w-72 h-72 flex flex-col items-center justify-center text-center shadow-lg">
                <img src="/assets/img/homepage/tanda-seru.png" alt="" class="mb-6 w-12 h-12">
                <h3 class="font-bold text-lg mb-2">Test Gaya Belajar Adaptif</h3>
                <p class="text-sm">Mengidentifikasi tipe belajar siswa untuk menyesuaikan konten dan metode pembelajaran
                    secara personal.</p>
            </div>

            <!-- Card 2 -->
            <div
                class="bg-[#5C2C06] text-white p-6 rounded-2xl w-72 h-72 flex flex-col items-center justify-center text-center shadow-lg">
                <img src="/assets/img/homepage/tanda-seru.png" alt="" class="mb-6 w-12 h-12">
                <h3 class="font-bold text-lg mb-2">Konten Etnomatematika Daerah Malang</h3>
                <p class="text-sm">Mengaitkan materi dengan budaya khas Malang agar pembelajaran lebih bermakna.</p>
            </div>

            <!-- Card 3 -->
            <div
                class="bg-[#5C2C06] text-white p-6 rounded-2xl w-72 h-72 flex flex-col items-center justify-center text-center shadow-lg">
                <img src="/assets/img/homepage/tanda-seru.png" alt="" class="mb-6 w-12 h-12">
                <h3 class="font-bold text-lg mb-2">Quiz Adaptif Berbasis AI</h3>
                <p class="text-sm">Soal latihan otomatis yang sesuai kemampuan siswa dan konteks budaya.</p>
            </div>
        </div>

        <!-- Baris Kedua: 2 Card di Tengah -->
        <div class="flex flex-col items-center md:flex-row justify-center gap-8 pt-10">
            <!-- Card 4 -->
            <div
                class="bg-[#5C2C06] text-white p-6 rounded-2xl w-72 h-72 flex flex-col items-center justify-center text-center shadow-lg">
                <img src="/assets/img/homepage/tanda-seru.png" alt="" class="mb-6 w-12 h-12">
                <h3 class="font-bold text-lg mb-2">Penyajian Materi Sesuai Gaya Belajar</h3>
                <p class="text-sm">Soal latihan disesuaikan dengan tingkat kemampuan dan gaya belajar siswa.</p>
            </div>

            <!-- Card 5 -->
            <div
                class="bg-[#5C2C06] text-white p-6 rounded-2xl w-72 h-72 flex flex-col items-center justify-center text-center shadow-lg">
                <img src="/assets/img/homepage/tanda-seru.png" alt="" class="mb-6 w-12 h-12">
                <h3 class="font-bold text-lg mb-2">Dashboard Belajar Personal</h3>
                <p class="text-sm">Menampilkan perjalanan belajar sesuai profil pengguna untuk navigasi yang efisien.</p>
            </div>
        </div>
    </div>
@endsection
