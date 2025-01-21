@extends('layouts.master-layout')

@section('content')
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <b>
            <h1 class="text-3xl">Hai, {{ Auth::user()->name }} 👋</h1>
        </b>
        <p class="mt-4">Welcome to your dashboard.</p>

        {{-- layout --}}
        <div class="grid grid-cols-1 gap-4 mt-8  md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
            <div class="p-4 dark:bg-gray-700 dark:text-gray-200 shadow-md  rounded-lg">
                <h5 class="text-lg font-semibold ">Active/Inactive Course Data</h5>
                <div id="status-chart"></div>
            </div>
            <div class="p-4 dark:bg-gray-700 dark:text-gray-200 shadow-md rounded-lg">
                <h2 class="text-lg font-semibold">Number of Students</h2>
                <div id="status-chart-siswa-pembayaran"></div> <!-- Pastikan ID ini sesuai -->
            </div>
            <div class="p-4 dark:bg-gray-700 dark:text-gray-200 shadow-md rounded-lg">
                <h2 class="text-lg font-semibold">Student and Course Count</h2>
                <p class="text-sm text-gray-900 dark:text-gray-100">
                    Count of students: {{ $siswaCount }} <br>
                    Count of courses: {{ $getDataManajamend }}
                </p>
            </div>
        </div>
    </div>

    <script>
        // Manajemen data siswa
        var Lunas = {{ $siswaLunasCount }};
        var inLunas = {{ $siswaBelumLunasCount }};
    
        // Pastikan data sudah benar, jika null atau undefined, set default
        if (typeof Lunas === 'undefined') Lunas = 0;
        if (typeof inLunas === 'undefined') inLunas = 0;
    
        var optionsSiswa = {
            chart: {
                type: 'pie',
                height: 350,
                background: 'transparent' // Menyesuaikan dengan tema
            },
            labels: ['Lunas', 'Belum Lunas'],
            series: [Lunas, inLunas],
            colors: ['#28a745', '#dc3545'], // Warna tetap
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: '100%',
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
    
        // Inisialisasi chart untuk status pembayaran siswa
        var pembayaran = new ApexCharts(document.querySelector("#status-chart-siswa-pembayaran"), optionsSiswa);
        pembayaran.render();
    
        // Manajemen data course
        var activeCount = {{ $activeCount }};
        var inactiveCount = {{ $inactiveCount }};
    
        var optionsCourse = {
            chart: {
                type: 'pie',
                height: 350,
                background: 'transparent' // Menyesuaikan dengan tema
            },
            labels: ['Aktif', 'Tidak Aktif'],
            series: [activeCount, inactiveCount],
            colors: ['#28a745', '#dc3545'], // Warna tetap
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: '100%',
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
    
        // Inisialisasi chart untuk status data manajemen kursus
        var chart = new ApexCharts(document.querySelector("#status-chart"), optionsCourse);
        chart.render();
    </script>
    
@endsection
