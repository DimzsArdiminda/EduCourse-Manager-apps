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
            <p class="mt-4">Welcome to your profile. <br>
                    Disini anda bisa membuat materi pembelajaran, siapkan link Gdrive materi anda (PDF disarankan) <br>
                    Dan anda bisa memberikan soal latihan untuk siswa anda dengan mengirimkan link Google Form yang sudah anda buat.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 mt-5">
                <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-4 flex flex-col items-center">
                    <span class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $countAllMateri }}</span>
                    <span class="text-sm text-blue-800 dark:text-blue-200 mt-2">Total Materi</span>
                </div>
                <div class="bg-green-100 dark:bg-green-900 rounded-lg p-4 flex flex-col items-center">
                    <span class="text-2xl font-bold text-green-700 dark:text-green-300">{{ $countMateriAudio }}</span>
                    <span class="text-sm text-green-800 dark:text-green-200 mt-2">Materi Auditori</span>
                </div>
                <div class="bg-yellow-100 dark:bg-yellow-900 rounded-lg p-4 flex flex-col items-center">
                    <span class="text-2xl font-bold text-yellow-700 dark:text-yellow-300">{{ $countMateriVisual }}</span>
                    <span class="text-sm text-yellow-800 dark:text-yellow-200 mt-2">Materi Visual</span>
                </div>
                <div class="bg-purple-100 dark:bg-purple-900 rounded-lg p-4 flex flex-col items-center">
                    <span class="text-2xl font-bold text-purple-700 dark:text-purple-300">{{ $countMateriKinestetik }}</span>
                    <span class="text-sm text-purple-800 dark:text-purple-200 mt-2">Materi Kinestetik</span>
                </div>
            </div>
            
            <div class=" bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-6 mt-3">
                <div class="p-6">
                    <form action="{{ route('materi.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="judul_materi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Materi</label>
                            <input required name="judul_materi" placeholder="Probabilitas - Dasar" type="text" id="judul_materi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="flex items-center mb-6">
                            <label for="tipe_materi" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipe Materi</label>
                            <select id="tipe_materi" name="tipe_materi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="video">Video</option>
                                <option value="file">File</option>
                            </select>
                        </div>
                        
                        {{-- tipe file --}}
                        <div class="mb-6" id="file-section">
                            <div id="preview-container" class="mt-4 hidden">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preview Materi</label>
                                <iframe id="preview-frame" class="w-full h-96 border rounded" frameborder="0"></iframe>
                            </div>
                            <label for="link_materi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Materi</label>
                            <input name="link_materi" placeholder="https://drive.google.com/..." type="text" id="link_materi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <span id="gdrive-warning" class="text-red-500 text-sm hidden">
                                Link Google Drive harus menggunakan akses <strong>Anyone with the link can view</strong> (usp=sharing).
                            </span>
                            <span id="gdrive-invalid" class="text-red-500 text-sm hidden">
                                Format link Google Drive tidak valid. Gunakan format: <br>
                                <code>https://drive.google.com/file/d/.../view?usp=sharing</code>
                            </span>
                        </div>                        
                        
                        {{-- tipe video --}}
                        <div class="mb-6" id="video-section">
                            <div id="video-preview-container" class="mt-4 mb-2 hidden">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preview Video</label>
                                <iframe id="video-preview-frame" class="w-full h-96 border rounded" frameborder="0" allowfullscreen></iframe>
                            </div>
                            <label for="link_video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Video</label>
                            <input name="link_video" placeholder="https://www.youtube.com/watch?v=..." type="text" id="link_video" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <span id="youtube-invalid" class="text-red-500 text-sm hidden">
                                Format link YouTube tidak valid. Gunakan format: <br>
                                <code>https://www.youtube.com/watch?v=...</code> atau <code>https://youtu.be/...</code>
                            </span>
                        </div>

                        
                        <div class="mb-6">
                            <label for="link_gform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Gform Penugasan</label>
                            <input required name="link_gform" placeholder="https://drive.google.com/..." type="text" id="link_gform" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        
                        <div class="flex items-center mb-6">
                            <label for="tipe_ajaran" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipe Belajar</label>
                            <select id="tipe_ajaran" name="tipe_ajaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="auditori">Auditori</option>
                                <option value="kinestetik">Kinestetik</option>
                                <option value="visual">Visual</option>
                            </select>
                        </div>
                        
                        <button type="submit" id="submit-button" disabled class="mt-4 bg-blue-600 text-white px-4 py-2 rounded disabled:bg-gray-400 disabled:cursor-not-allowed">
                            Simpan Materi
                        </button>

                    </form>
                </div>
            </div>
        @endif
        <div class=" bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-6 mt-3">
            <div class="p-6">
            <div class="mb-4">
                <input type="text" id="search-materi" placeholder="Cari judul materi..." class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white" />
            </div>
                @if (Auth::user()->hasRole('guru'))
                    <h2 class="text-2xl mb-4">Daftar Materi Anda</h2>
                    <div id="materi-list">
                        @if ($getAllMateri->isEmpty())
                            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-600 rounded-lg text-center">
                                <span class="text-gray-500 dark:text-gray-300">Belum ada materi yang tersedia.</span>
                            </div>
                        @else
                            <div id="materi-list">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach ($getAllMateri->chunk(6) as $materiChunk)
                                        @foreach ($materiChunk as $materi)
                                            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-600 rounded-lg materi-item">
                                                <h2 class="text-xl font-semibold materi-title">{{ $materi->title }}</h2>
                                                <p class="text-gray-700 dark:text-gray-300 mt-2">
                                                    Tipe Materi: {{ $materi->tipe }}<br>
                                                    Tipe Belajar: {{ $materi->tipe_belajar }}
                                                </p>
                                                <div class="flex items-center mt-3 space-x-2">
                                                    <a href="{{ route('materi.show', $materi->id) }}" class="inline-block bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition align-middle">
                                                        Review Materi
                                                    </a>
                                                    <form action="{{ route('materi.delete', $materi->id) }}" method="POST" class="inline-block delete-materi-form align-middle">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700 transition">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                    <button type="button" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600 transition open-edit-modal" 
                                                        data-id="{{ $materi->id }}"
                                                        data-title="{{ $materi->title }}"
                                                        data-link="{{ $materi->link_materi }}"
                                                        data-tipe="{{ $materi->tipe }}"
                                                        data-link_gform="{{ $materi->link_gform }}"
                                                        data-tipe_belajar="{{ $materi->tipe_belajar }}">
                                                        Edit
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                @elseif(Auth::user()->hasRole('siswa'))
                    <div id="materi-list">
                        @foreach ($getMateriAudio as $materi)
                            @if ($getMateriAudio->isEmpty())
                                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-600 rounded-lg text-center">
                                <span class="text-gray-500 dark:text-gray-300">Belum ada materi yang tersedia.</span>
                                </div>
                            @else
                                <div id="materi-list">
                                @foreach ($getMateriAudio as $materi)
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        @foreach ($getMateriAudio->chunk(6) as $materiChunk)
                                            @foreach ($materiChunk as $materi)
                                                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-600 rounded-lg materi-item">
                                                    <h2 class="text-xl font-semibold materi-title">{{ $materi->title }}</h2>
                                                    <p class="text-gray-700 dark:text-gray-300 mt-2">Tipe Materi: {{ $materi->tipe }}<br>Tipe Belajar: {{ $materi->tipe_belajar }}</p>
                                                    <div class="flex items-center mt-3 space-x-2">
                                                        <a href="{{ $materi->link_materi }}" class="inline-block bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition align-middle">
                                                            Review Materi
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- sction visual --}}
                    <div id="materi-list">
                        @foreach ($getMateriVisual as $materi)
                            @if ($getMateriVisual->isEmpty())
                                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-600 rounded-lg text-center">
                                <span class="text-gray-500 dark:text-gray-300">Belum ada materi yang tersedia.</span>
                                </div>
                            @else
                                <div id="materi-list">
                                @foreach ($getMateriVisual as $materi)
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        @foreach ($getMateriVisual->chunk(6) as $materiChunk)
                                            @foreach ($materiChunk as $materi)
                                                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-600 rounded-lg materi-item">
                                                    <h2 class="text-xl font-semibold materi-title">{{ $materi->title }}</h2>
                                                    <p class="text-gray-700 dark:text-gray-300 mt-2">Tipe Materi: {{ $materi->tipe }}<br>Tipe Belajar: {{ $materi->tipe_belajar }}</p>
                                                    <div class="flex items-center mt-3 space-x-2">
                                                        <a href="{{ $materi->link_materi }}" class="inline-block bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition align-middle">
                                                            Review Materi
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- sction kinestetik --}}
                    <div id="materi-list">
                        @foreach ($getMateriKinestetik as $materi)
                            @if ($getMateriKinestetik->isEmpty())
                                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-600 rounded-lg text-center">
                                <span class="text-gray-500 dark:text-gray-300">Belum ada materi yang tersedia.</span>
                                </div>
                            @else
                                <div id="materi-list">
                                @foreach ($getMateriKinestetik as $materi)
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        @foreach ($getMateriKinestetik->chunk(6) as $materiChunk)
                                            @foreach ($materiChunk as $materi)
                                                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-600 rounded-lg materi-item">
                                                    <h2 class="text-xl font-semibold materi-title">{{ $materi->title }}</h2>
                                                    <p class="text-gray-700 dark:text-gray-300 mt-2">Tipe Materi: {{ $materi->tipe }}<br>Tipe Belajar: {{ $materi->tipe_belajar }}</p>
                                                    <div class="flex items-center mt-3 space-x-2">
                                                        <a href="{{ $materi->link_materi }}" class="inline-block bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition align-middle">
                                                            Review Materi
                                                        </a>
                                                    
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>


                @endif
            </div>
        </div>
        
    </div>


    <div id="editMateriModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg">
            <h2 class="text-xl font-bold mb-4">Edit Materi</h2>
            <form id="editMateriForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Judul Materi</label>
                    <input type="text" name="title" id="edit-title" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Link Materi</label>
                    <input type="text" name="link_materi" id="edit-link" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Tipe Materi</label>
                    <select name="tipe" id="edit-tipe" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white" required>
                        <option value="video">Video</option>
                        <option value="file">File</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Tipe Belajar</label>
                    <select name="tipe_belajar" id="edit-tipe-belajar" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white" required>
                        <option value="auditori">Auditori</option>
                        <option value="kinestetik">Kinestetik</option>
                        <option value="visual">Visual</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Google Form</label>
                    <input type="text" name="link_gform" id="edit-link-gform" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeEditModal" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('editMateriModal');
        const closeBtn = document.getElementById('closeEditModal');
        const editForm = document.getElementById('editMateriForm');
        const titleInput = document.getElementById('edit-title');
        const linkInput = document.getElementById('edit-link');
        const tipeInput = document.getElementById('edit-tipe');
        const linkGformInput = document.getElementById('edit-link-gform');
        const tipeBelajarInput = document.getElementById('edit-tipe-belajar');

        document.querySelectorAll('.open-edit-modal').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                titleInput.value = this.dataset.title;
                linkInput.value = this.dataset.link;
                tipeInput.value = this.dataset.tipe;
                linkGformInput.value = this.dataset.link_gform;
                tipeBelajarInput.value = this.dataset.tipe_belajar;
                editForm.action = `materi/edit/${id}`;
                modal.classList.remove('hidden');
            });
        });

        closeBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
        });

        // Close modal on background click
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const tipeMateri = document.getElementById('tipe_materi');
        const fileSection = document.getElementById('file-section');
        const videoSection = document.getElementById('video-section');

        function toggleSections() {
            if (tipeMateri.value === 'video') {
                fileSection.style.display = 'none';
                videoSection.style.display = '';
                // Hapus required dari input file dan tambahkan ke input video
                document.getElementById('link_materi').removeAttribute('required');
                document.getElementById('link_video').setAttribute('required', '');
            } else {
                fileSection.style.display = '';
                videoSection.style.display = 'none';
                // Hapus required dari input video dan tambahkan ke input file
                document.getElementById('link_video').removeAttribute('required');
                document.getElementById('link_materi').setAttribute('required', '');
            }
        }

        tipeMateri.addEventListener('change', toggleSections);

        // Inisialisasi awal
        toggleSections();
    });

    document.addEventListener('DOMContentLoaded', function () {
        const videoInput = document.getElementById('link_video');
        const videoPreviewContainer = document.getElementById('video-preview-container');
        const videoPreviewFrame = document.getElementById('video-preview-frame');

        function getYoutubeEmbedUrl(url) {
            // Mendukung format standar YouTube
            const match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/);
            if (match) {
                const videoId = match[1];
                return `https://www.youtube.com/embed/${videoId}`;
            }
            return null;
        }

        function updateVideoPreview() {
            const url = videoInput.value.trim();
            const embedUrl = getYoutubeEmbedUrl(url);
            if (embedUrl) {
                videoPreviewFrame.src = embedUrl;
                videoPreviewContainer.classList.remove('hidden');
            } else {
                videoPreviewFrame.src = '';
                videoPreviewContainer.classList.add('hidden');
            }
        }

        videoInput.addEventListener('input', updateVideoPreview);
        videoInput.addEventListener('blur', updateVideoPreview);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-materi-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus materi ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
    
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-materi');
        const materiItems = document.querySelectorAll('.materi-item');

        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            materiItems.forEach(function (item) {
            const title = item.querySelector('.materi-title').textContent.toLowerCase();
            if (title.includes(query)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('link_materi');
        const previewContainer = document.getElementById('preview-container');
        const previewFrame = document.getElementById('preview-frame');

        function getPreviewUrl(url) {
            // Mendukung preview PDF dan Word dari Google Drive
            const match = url.match(/^https:\/\/drive\.google\.com\/file\/d\/([\w-]+)\/view\?usp=sharing$/);
            if (match) {
                const fileId = match[1];
                // Google Drive preview
                return `https://drive.google.com/file/d/${fileId}/preview`;
            }
            return null;
        }

        function updatePreview() {
            const url = input.value.trim();
            const previewUrl = getPreviewUrl(url);
            if (previewUrl) {
                previewFrame.src = previewUrl;
                previewContainer.classList.remove('hidden');
            } else {
                previewFrame.src = '';
                previewContainer.classList.add('hidden');
            }
        }

        input.addEventListener('input', updatePreview);
        input.addEventListener('blur', updatePreview);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('link_materi');
        const videoInput = document.getElementById('link_video');
        const warning = document.getElementById('gdrive-warning');
        const invalid = document.getElementById('gdrive-invalid');
        const youtubeInvalid = document.getElementById('youtube-invalid');
        const submitButton = document.getElementById('submit-button');
        const tipeMateri = document.getElementById('tipe_materi');

        function isStrictValidGDriveLink(url) {
            const strictPattern = /^https:\/\/drive\.google\.com\/file\/d\/[\w-]+\/view\?usp=sharing$/;
            return strictPattern.test(url);
        }

        function validateForm() {
            // Jika tipe materi adalah video, validasi input video
            if (tipeMateri.value === 'video') {
                warning.classList.add('hidden');
                invalid.classList.add('hidden');
                
                // Validasi video input (YouTube link)
                const videoValue = videoInput.value.trim();
                if (videoValue === '') {
                    youtubeInvalid.classList.add('hidden');
                    submitButton.disabled = true;
                    return;
                }
                
                // Validasi format YouTube
                const youtubePattern = /(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/;
                if (!youtubePattern.test(videoValue)) {
                    youtubeInvalid.classList.remove('hidden');
                    submitButton.disabled = true;
                    return;
                }
                
                youtubeInvalid.classList.add('hidden');
                submitButton.disabled = false;
                return;
            }

            // Jika tipe materi adalah file, validasi Google Drive link
            youtubeInvalid.classList.add('hidden');
            const value = input.value.trim();

            if (value === '') {
                warning.classList.add('hidden');
                invalid.classList.add('hidden');
                submitButton.disabled = true;
                return;
            }

            if (!isStrictValidGDriveLink(value)) {
                invalid.classList.remove('hidden');
                warning.classList.add('hidden');
                submitButton.disabled = true;
                return;
            }

            invalid.classList.add('hidden');
            warning.classList.add('hidden');
            submitButton.disabled = false;
        }

        input.addEventListener('input', validateForm);
        input.addEventListener('blur', validateForm);
        videoInput.addEventListener('input', validateForm);
        videoInput.addEventListener('blur', validateForm);
        tipeMateri.addEventListener('change', validateForm); // re-validate on tipe change
        
        // Validasi awal saat halaman dimuat
        validateForm();
    });
</script>
@endsection
