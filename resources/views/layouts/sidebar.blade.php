<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">

    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <a href="{{ url('/dashboard') }}" class="flex items-center mb-5">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="h-8 w-8 mr-3">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Educourse - Manage</h1>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                    class="w-full flex  p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>


                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            @if (Auth::user()->hasRole('guru'))
                <li>
                    <a href="{{ route('materi.index') }}"
                        class="w-full flex  p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.5 6.75V18a2.25 2.25 0 002.25 2.25h10.5A2.25 2.25 0 0019.5 18V6.75M4.5 6.75A2.25 2.25 0 016.75 4.5h10.5A2.25 2.25 0 0119.5 6.75M4.5 6.75h15M8.25 10.5h7.5M8.25 14.25h4.5" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Materi</span>
                    </a>
                </li>
                <li>
                    <a href="/"
                        class="w-full flex  p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 2.25c5.385 0 9.75 4.365 9.75 9.75S17.385 21.75 12 21.75 2.25 17.385 2.25 12 6.615 2.25 12 2.25Zm0 3a6.75 6.75 0 1 0 .001 13.5A6.75 6.75 0 0 0 12 5.25Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Hasil Pengumpulan Soal</span>
                    </a>
                </li>
                <li>
                    <a href="/"
                        class="w-full flex  p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 2.25c5.385 0 9.75 4.365 9.75 9.75S17.385 21.75 12 21.75 2.25 17.385 2.25 12 6.615 2.25 12 2.25Zm0 3a6.75 6.75 0 1 0 .001 13.5A6.75 6.75 0 0 0 12 5.25Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Riwayat Pengerjaan Soal</span>
                    </a>
                </li>
            @else
                {{-- <li>
                    <a href="/"
                        class="w-full flex  p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 2.25c5.385 0 9.75 4.365 9.75 9.75S17.385 21.75 12 21.75 2.25 17.385 2.25 12 6.615 2.25 12 2.25Zm0 3a6.75 6.75 0 1 0 .001 13.5A6.75 6.75 0 0 0 12 5.25Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Membaca Materi</span>
                    </a>
                </li> --}}
                <li>
                    <a href="/"
                        class="w-full flex  p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 2.25c5.385 0 9.75 4.365 9.75 9.75S17.385 21.75 12 21.75 2.25 17.385 2.25 12 6.615 2.25 12 2.25Zm0 3a6.75 6.75 0 1 0 .001 13.5A6.75 6.75 0 0 0 12 5.25Z"
                            />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Generate Soal</span>
                    </a>
                </li>
            @endif

            {{-- <li>
                <a href="{{ route('courses') }}"
                    class="w-full flex  p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Course</span>
                </a>
            </li> --}}
            {{-- <li>
                <a href="{{ route('siswa') }}"
                    class="w-full flex  p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Students</span>
                </a>
            </li> --}}
            

            <hr class="my-4 border-gray-200 dark:border-gray-600" />
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="w-full flex  p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>

                    <span class="ms-3">Profile</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="javascript:void(0);"
                        class="w-full flex p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200"
                        onclick="confirmLogout(event)">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>



</aside>
