@extends('layouts.master-layout')
@section('content')


    <div class="p-6 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700">
        <b>
                <h1 class="text-3xl">Hai, {{ Auth::user()->name }} 👋</h1>
        </b>

        <div class="mt-3">
            @include('components.alerts')
        </div>

        {{-- form input tanggal --}}
        @if (Auth::user()->hasRole('guru'))
            <p class="mt-4">Halaman Membuat Materi. <br>
                    Disini anda bisa membuat materi pembelajaran, siapkan link Gdrive materi anda (PDF disarankan) <br>
                    Dan anda bisa memberikan soal latihan untuk siswa anda dengan mengirimkan link Google Form yang sudah anda buat.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 mt-5">
                <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-4 flex flex-col items-center">
                    <span class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $countAllMateri = 80 }}</span>
                    <span class="text-sm text-blue-800 dark:text-blue-200 mt-2">Total Materi</span>
                </div>
                <div class="bg-green-100 dark:bg-green-900 rounded-lg p-4 flex flex-col items-center">
                    <span class="text-2xl font-bold text-green-700 dark:text-green-300">{{ $countMateriAudio  = 80 }}</span>
                    <span class="text-sm text-green-800 dark:text-green-200 mt-2">Materi Auditori</span>
                </div>
                <div class="bg-yellow-100 dark:bg-yellow-900 rounded-lg p-4 flex flex-col items-center">
                    <span class="text-2xl font-bold text-yellow-700 dark:text-yellow-300">{{ $countMateriVisual  = 80 }}</span>
                    <span class="text-sm text-yellow-800 dark:text-yellow-200 mt-2">Materi Visual</span>
                </div>
                <div class="bg-purple-100 dark:bg-purple-900 rounded-lg p-4 flex flex-col items-center">
                    <span class="text-2xl font-bold text-purple-700 dark:text-purple-300">{{ $countMateriKinestetik  = 80 }}</span>
                    <span class="text-sm text-purple-800 dark:text-purple-200 mt-2">Materi Kinestetik</span>
                </div>
            </div>
            
            <div class=" bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-6 mt-3">
                <div class="p-6">
                    <form action="{{ route('pengumpulan.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="judul_materi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Penugasan</label>
                            <input required name="judul_materi" placeholder="UAS - Probablitas" type="text" id="judul_materi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        
                        
                        <div class="mb-6">
                            <label for="link_gform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Gform Penugasan</label>
                            <input required name="link_gform" placeholder="https://drive.google.com/..." type="text" id="link_gform" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        
                        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded disabled:bg-gray-400 disabled:cursor-not-allowed">
                            Simpan Materi
                        </button>

                    </form>
                </div>
            </div>
        @else
        <p class="mt-4">Halaman Materi. <br>
                Disini anda bisa melihat materi pembelajaran yang telah dibuat oleh guru anda.
                <br>
                Silahkan pilih materi yang ingin anda pelajari.
        </p>
        @endif
        <div class=" bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-6 mt-3">
            <div class="p-6">
                @if (Auth::user()->hasRole('guru'))
                @foreach ($getAllPenugasan as $materi)
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg shadow flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $materi->nama_penugasan }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $materi->created_at->format('d M Y') }}</p>
                            <a href="{{ $materi->link_penugasan }}" target="_blank" class="inline-block mt-2 text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                                Lihat Gform
                            </a>
                        </div>
                        <div class="mt-4 md:mt-0 flex gap-2">
                            <!-- Tombol Edit -->
                            <a href="#" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition text-sm shadow"
                                data-modal-target="editModal-{{ $materi->id }}" 
                                data-modal-toggle="editModal-{{ $materi->id }}">
                                Edit
                            </a>

                            <!-- Modal Edit -->
                            <div id="editModal-{{ $materi->id }}" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full bg-black bg-opacity-50 flex items-center justify-center">
                                 <div class="relative w-full max-w-md h-full md:h-auto">
                                      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div class="flex justify-between items-center p-4 border-b rounded-t dark:border-gray-600">
                                                 <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                      Edit Penugasan
                                                 </h3>
                                                 <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="editModal-{{ $materi->id }}">
                                                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                 </button>
                                            </div>
                                            <form action="{{ route('pengumpulan.edit', $materi->id) }}" method="POST" class="p-6">
                                                 @csrf
                                                 @method('PUT')
                                                 <div class="mb-4">
                                                      <label for="edit_judul_materi_{{ $materi->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Penugasan</label>
                                                      <input required name="judul_materi" type="text" id="edit_judul_materi_{{ $materi->id }}" value="{{ $materi->nama_penugasan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                 </div>
                                                 <div class="mb-4">
                                                      <label for="edit_link_gform_{{ $materi->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Gform Penugasan</label>
                                                      <input required name="link_gform" type="text" id="edit_link_gform_{{ $materi->id }}" value="{{ $materi->link_penugasan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                 </div>
                                                 <div class="flex justify-end">
                                                      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mr-2">Simpan</button>
                                                      <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded" data-modal-hide="editModal-{{ $materi->id }}">Batal</button>
                                                 </div>
                                            </form>
                                      </div>
                                 </div>
                            </div>
                            <form action="{{ route('pengumpulan.delete', $materi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penugasan ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition text-sm shadow">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                @else
                 @forEach ($getAllPenugasan as $materi)
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg shadow flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $materi->nama_penugasan }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $materi->created_at->format('d M Y') }}</p>
                            <a href="{{ $materi->link_penugasan }}" target="_blank" class="inline-block mt-2 text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                                Lihat Gform
                            </a>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
        
    </div>
@endsection
