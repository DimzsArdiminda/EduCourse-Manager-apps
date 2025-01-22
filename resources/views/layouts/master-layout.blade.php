<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
     <link href="https://cdn.datatables.net/v/dt/dt-2.2.1/datatables.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 0.375rem;
        background-color: #f3f4f6;
        border: 1px solid #d1d5db;
        color: #374151;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #d1d5db;
        color: #111827;
        border: 1px solid #2563eb;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #2563eb;
        color: #ffffff !important;
        border: 1px solid #2563eb;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
    }

    @media (max-width: 768px) {
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.25rem 0.5rem;
            margin: 0 0.125rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            padding: 0.25rem 0.5rem;
            margin: 0 0.125rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 100%;
            max-width: 150px;
        }

        .dataTables_wrapper .dataTables_length select {
            width: 100%;
            max-width: 100px;
        }
    }
         /* Styling untuk Search Bar */
    .dataTables_wrapper .dataTables_filter input {
        padding: 0.25rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        outline: none;
        transition: border-color 0.3s ease;
        width: 100%;
        max-width: 200px;
        background-color: white;
        color: black;
    }

    @media (color-theme: dark) {
        .dataTables_wrapper .dataTables_filter input {
            background-color: #1f2937;
            color: #d1d5db;
        }
    }
    

     /* Styling untuk Dropdown (Length Menu) */
     .dataTables_wrapper .dataTables_length select {
        padding-left: 0.2rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        outline: none;
        transition: border-color 0.3s ease;
        background-color: white;
        color: black;
    }

    @media (color-theme: dark) {
        .dataTables_wrapper .dataTables_length select {
            background-color: #1f2937;
            color: #d1d5db;
        }
    }


    #courses-table th svg {
        margin-left: 0.25rem;
        margin-top: 0.25rem;
        width: 16px; /* Menyesuaikan ukuran ikon agar tidak terlalu besar */
        height: 16px;
    }


    /* Styling untuk icon dalam th */
    #courses-table th svg {
        display: inline-block;
        vertical-align: middle;
    }

    /* Menambahkan hover efek untuk header */
    #courses-table th:hover {
        /* hover animation up */
        cursor: pointer;
    }
    </style>

    </style>
    <title>@yield('title', 'Educourse')</title>
</head>
<body class="font-sans antialiased ">
    @include('layouts.sidebar')

    <div class="min-h-screen dark:bg-gray-700 dark:text-gray-200  ">
        <div class="p-4 sm:ml-64">
            @yield('content')
        </div>
    </div>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
{{-- <script src="https://cdn.datatables.net/v/dt/dt-2.2.1/r-3.0.3/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/datatables.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="{{ asset('/app.js') }}"></script>

 
    
   <script>

    document.addEventListener('DOMContentLoaded', () => {
        // Ambil semua tombol
        const buttons = document.querySelectorAll('.btn-toggle-form');
        const forms = document.querySelectorAll('.form-section');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Ambil target form dari atribut data-target
                const target = button.getAttribute('data-target');

                // Sembunyikan semua form
                forms.forEach(form => {
                    form.classList.add('hidden');
                });

                // Tampilkan form yang sesuai
                const targetForm = document.getElementById(target);
                if (targetForm) {
                    targetForm.classList.remove('hidden');
                }
            });
        });
    });

     $(document).ready(function () {
        $('#selectCourse').select2({
            placeholder: 'Input course name',
            ajax: {
                url: '{{ route("select.courses") }}', // URL API untuk mengambil data
                dataType: 'json',
                delay: 250, // Delay pencarian
                data: function (params) {
                    return {
                        q: params.term // Kirimkan teks pencarian ke backend
                    };
                },
                processResults: function (data) {
                    // Map hasil pencarian ke format Select2
                    var formattedData = data.results.map(function (item) {
                        return {
                            id: item.id,
                            text: item.Nama_kursus
                        };
                    });

                    return {
                        results: formattedData
                    };
                },
                cache: true
            },
            minimumInputLength: 3 // Minimal 3 karakter untuk pencarian
        });
    });



     function confirmDelete(courseId) {
    Swal.fire({
      title: 'Delete data ?',
      showCancelButton: true,
      reverseButtons: false,
    }).then((result) => {
      if (result.value) {
        document.getElementById('delete-form-' + courseId).submit();
      }
    });
  }
     $(document).ready(function () {
    $('#courses-table').DataTable({
        responsive: true,
        pageLength: 3,

        lengthMenu: [5, 10, 25, 50, 75, 100],
        // dom: '<"flex justify-between items-center mb-4"lf>t<"flex justify-between items-center mt-4"ip>',
        dom: '<"flex justify-between items-center mb-4"lf>t<"flex justify-between items-center mt-4"ip>',
        language: {
            infoFiltered: "(filtered from a total of _MAX_ entries)",
            paginate: {
                first: "Start ",
                last: "End ",
                next: " Next ",
                previous: " Previous "
            },
            // dom: '<"flex justify-between items-center mb-4"lf>t<"flex justify-between items-center mt-4"ip>'
            zeroRecords: "No data found"
        }
    });
});

   </script>
</body>
</html>