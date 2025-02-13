@extends('layouts.master-layout')

@section('content')
    <div class="p-6 text-gray-900 dark:text-gray-100" style="overflow-x: auto;">
        <b>
            <h1 class="text-3xl">Courses Data</h1>
        </b>

          
        @if(session('success'))
        <div class="mt-15 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.closest('.relative').style.display='none';">
                    <path d="M14.348 14.849a1 1 0 0 1-1.414 0L10 11.414l-2.934 2.935a1 1 0 1 1-1.414-1.414L8.586 10 5.651 7.065a1 1 0 1 1 1.414-1.414L10 8.586l2.934-2.935a1 1 0 1 1 1.414 1.414L11.414 10l2.934 2.935a1 1 0 0 1 0 1.414z"/>
                </svg>
            </span>
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            @if(is_array(session('error')))
                <ul>
                    @foreach(session('error') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                {{ session('error') }}
            @endif
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.closest('.relative').style.display='none';">
                    <path d="M14.348 14.849a1 1 0 0 1-1.414 0L10 11.414l-2.934 2.935a1 1 0 1 1-1.414-1.414L8.586 10 5.651 7.065a1 1 0 1 1 1.414-1.414L10 8.586l2.934-2.935a1 1 0 1 1 1.414 1.414L11.414 10l2.934 2.935a1 1 0 0 1 0 1.414z"/>
                </svg>
            </span>
        </div>
    @endif
    


    {{-- Tabel untuk menampilkan data --}}
    <div class="mt-15 ">
      <a href="{{ route('courses.add') }}">
          <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-4">
          Add Course
          </button>
      </a>
      <a href="{{ route('export.courses') }}">
          <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded my-4">
          Export to Excel
          </button>
      </a>
  {{-- Tombol untuk membuka modal --}}
    <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded my-4" id="openModal">
      Import from Excel
    </button>

    {{-- Modal --}}
    <div id="importModal" class="fixed inset-0 flex items-center justify-center  bg-black bg-opacity-50 hidden transition-opacity duration-300 ease-in-out">
      <div class="dark:bg-gray-700 dark:text-gray-200 bg-white rounded-lg shadow-lg p-6 w-1/3 transform transition-transform duration-300 ease-in-out scale-95 ">
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Import Excel File</h2>
        <form action="{{ route('courses.import.excel') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <label for="file">Available for .xlsx, .xls, .csv </label>
          <input type="file" name="file" accept=".xlsx, .xls, .csv" required class="mb-4">
          @error('file')
            <div class="text-red-500 mt-2 text-sm">
              {{ $message }}
            </div>
          @enderror
          <div class="flex justify-end space-x-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Import
            </button>
            <button type="button" id="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>

      <a href="{{ route('export.courses.export') }}">
          <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-4">
          Export to PDF
          </button>
      </a>
        <table id="courses-table" class="table-auto border-collapse dataTable text-gray-900 dark:text-gray-100" >
            <thead>
                <tr>
                    <th>No <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                      </svg>
                    </th>
                    <th>Courses
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                          </svg>
                    </th>
                    <th>Price <br> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                      </svg></th>
                    <th>Status<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                      </svg></th>
                    <th>Number of Registered Students<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                      </svg></th>
                    <th>Created At<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                      </svg></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $course->Nama_kursus }}</td>
                        <td>Rp {{ number_format($course->Harga, 0, ',', '.') }}</td>
                        <td>{{ $course->Status }}</td>
                        <td>{{ $course->jumlah_siswa_terdaftar ?? 0 }}</td>
                        <td>{{ \Carbon\Carbon::parse($course->created_at)->format('d-m-Y H:i') }}</td>
                        <td class="flex flex-col sm:flex-row gap-2 justify-center">
                            <a href="{{ route('courses.id', $course->id) }}" class="bg-orange-500 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            </a>
                            <a href="{{ route("courses.id.edit", $course->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 0 1 3.182 3.182L7.5 19.213 3 21l1.787-4.5L16.862 3.487z" />
                            </svg>
                            </a>
                            <form action="{{ route('courses.delete', $course->id) }}" method="POST" class="inline" id="delete-form-{{ $course->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center"
                              onclick="confirmDelete({{ $course->id }})">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                              </svg>
                            </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <script>
      document.getElementById('openModal').addEventListener('click', function() {
        const modal = document.getElementById('importModal');
        modal.classList.remove('hidden');
        setTimeout(() => {
          modal.classList.remove('opacity-0');
          modal.firstElementChild.classList.remove('scale-95');
        }, 10);
      });

      document.getElementById('closeModal').addEventListener('click', function() {
        const modal = document.getElementById('importModal');
        modal.classList.add('opacity-0');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => {
          modal.classList.add('hidden');
        }, 300);
      });
    </script>
@endsection
