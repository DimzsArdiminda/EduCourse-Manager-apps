@extends('layouts.master-layout')
@section('content')


    <div class="p-6 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800">
        <b>
                <h1 class="text-3xl">Hai, {{ Auth::user()->name }} 👋</h1>
        </b>
        
        {{-- form input tanggal --}}
        @if (Auth::user()->hasRole('guru'))
            <p class="mt-4">Welcome to your profile. <br>
                    Disini anda bisa membuat materi pembelajaran, siapkan link Gdrive materi anda (PDF disarankan) <br>
                    Dan anda bisa memberikan soal latihan untuk siswa anda dengan mengirimkan link Google Form yang sudah anda buat.
            </p>
            <div class=" bg-white dark:bg-gray-700 rounded-xl shadow-md overflow-hidden mb-6 mt-3">
                <div class="p-6">
                    <form action="{{ route('materi.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="judul_materi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Materi</label>
                            <input required name="judul_materi" placeholder="Probabilitas - Dasar" type="text" id="judul_materi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        
                        <div class="mb-6">
                            <label for="link_materi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Materi</label>
                            <input required name="link_materi" placeholder="https://drive.google.com/..." type="text" id="link_materi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <span id="gdrive-warning" class="text-red-500 text-sm hidden">
                                Link Google Drive harus menggunakan akses <strong>Anyone with the link can view</strong> (usp=sharing).
                            </span>
                            <span id="gdrive-invalid" class="text-red-500 text-sm hidden">
                                Format link Google Drive tidak valid. Gunakan format: <br>
                                <code>https://drive.google.com/file/d/.../view?usp=sharing</code>
                            </span>
                            <div id="preview-container" class="mt-4 hidden">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preview Materi</label>
                                <iframe id="preview-frame" class="w-full h-96 border rounded" frameborder="0"></iframe>
                            </div>
                        </div>
                        <script>
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
                        </script>
                            
                        
                        <div class="mb-6">
                            <label for="link_gform" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Gform Penugasan</label>
                            <input required name="link_gform" placeholder="https://drive.google.com/..." type="text" id="link_gform" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <button type="submit" id="submit-button" disabled class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                            Simpan Materi
                        </button>

                    </form>
                </div>
            </div>
            
        @endif
    </div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('link_materi');
        const warning = document.getElementById('gdrive-warning');
        const invalid = document.getElementById('gdrive-invalid');
        const submitButton = document.getElementById('submit-button');

        function isStrictValidGDriveLink(url) {
            // Harus: file -> view -> usp=sharing
            const strictPattern = /^https:\/\/drive\.google\.com\/file\/d\/[\w-]+\/view\?usp=sharing$/;
            return strictPattern.test(url);
        }

        function validateGDriveLink() {
            const value = input.value.trim();

            if (value === '') {
                warning.classList.add('hidden');
                invalid.classList.add('hidden');
                submitButton.disabled = true;
                return;
            }

            if (!isStrictValidGDriveLink(value)) {
                // Jika bukan link file Google Drive atau bukan akses "sharing"
                invalid.classList.remove('hidden'); // Tampilkan error invalid
                warning.classList.add('hidden'); // Sembunyikan warning sharing
                submitButton.disabled = true;
                return;
            }

            // Jika valid
            invalid.classList.add('hidden');
            warning.classList.add('hidden');
            submitButton.disabled = false;
        }

        input.addEventListener('input', validateGDriveLink);
        input.addEventListener('blur', validateGDriveLink);
    });
</script>
@endsection
