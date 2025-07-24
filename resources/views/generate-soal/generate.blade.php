@extends('layouts.master-layout')

@section('content')
    <div class="max-w-xl mx-auto mt-10">
        <h2 class="mb-6 text-2xl font-bold text-white">Generator Soal</h2>

        {{-- Form Generate Soal --}}
        <form action="{{ route('generate.soal.generated') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="tingkatan" class="block mb-2 text-sm font-medium text-white">Tingkat Kesulitan</label>
                <select name="tingkatan" id="tingkatan"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-black">
                    <option value="" class="text-black">-- Pilih Tingkatan --</option>
                    <option value="mudah" class="text-black" {{ old('tingkatan') == 'mudah' ? 'selected' : '' }}>Mudah
                    </option>
                    <option value="sedang" class="text-black" {{ old('tingkatan') == 'sedang' ? 'selected' : '' }}>Sedang
                    </option>
                    <option value="sulit" class="text-black" {{ old('tingkatan') == 'sulit' ? 'selected' : '' }}>Sulit
                    </option>
                </select>
                @error('tingkatan')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="jumlah" class="block mb-2 text-sm font-medium text-white">Jumlah Soal</label>
                <input type="number" name="jumlah" id="jumlah"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-black"
                    min="1" value="{{ old('jumlah', 1) }}">
                @error('jumlah')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Generate Soal</button>
        </form>

        @if (session('success'))
            <div class="mt-4 p-4 bg-green-500 rounded text-white">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mt-4 p-4 bg-red-500 rounded text-white">
                {{ session('error') }}
            </div>
        @endif

        <div class="max-w-3xl mx-auto mt-10 text-white">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Kumpulan Soal</h2>
                @if (isset($soals) && is_array($soals))
                    <div class="flex space-x-3">
                        <form action="{{ route('quiz.start') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition font-medium">
                                🎯 Mulai Kuis
                            </button>
                        </form>
                        <a href="{{ route('quiz.history') }}"
                            class="px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition font-medium">
                            📈 Riwayat Kuis
                        </a>
                    </div>
                @endif
            </div>

            @if (isset($error))
                <div class="p-4 bg-red-500 rounded">{{ $error }}</div>
                @if (isset($raw))
                    <pre class="mt-4 bg-gray-800 p-4 rounded">{{ $raw }}</pre>
                @endif
            @elseif(isset($soals) && is_array($soals))
                <div class="mb-4 p-3 bg-blue-600 rounded-lg">
                    <p class="text-sm">
                        <strong>Tingkat Kesulitan:</strong> {{ ucfirst($tingkatan ?? '') }} |
                        <strong>Jumlah Soal:</strong> {{ count($soals) }} soal
                    </p>
                </div>

                @foreach ($soals as $index => $soal)
                    <div class="mb-6 p-4 bg-gray-800 rounded-lg">
                        <h3 class="font-semibold mb-2 text-yellow-400">Soal {{ $index + 1 }}:</h3>
                        <p class="mb-3 text-gray-100">{{ $soal['pertanyaan'] }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-3">
                            <div class="p-2 bg-gray-700 rounded">
                                <strong class="text-blue-400">A:</strong> {{ $soal['opsi']['a'] }}
                            </div>
                            <div class="p-2 bg-gray-700 rounded">
                                <strong class="text-blue-400">B:</strong> {{ $soal['opsi']['b'] }}
                            </div>
                            <div class="p-2 bg-gray-700 rounded">
                                <strong class="text-blue-400">C:</strong> {{ $soal['opsi']['c'] }}
                            </div>
                            <div class="p-2 bg-gray-700 rounded">
                                <strong class="text-blue-400">D:</strong> {{ $soal['opsi']['d'] }}
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-8 p-4 bg-gray-800 rounded-lg text-center">
                    <form action="{{ route('quiz.start') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition font-bold text-lg">
                            🚀 Mulai Mengerjakan Kuis
                        </button>
                    </form>
                </div>
            @else
                <p class="text-gray-400 text-center py-8">Generate soal terlebih dahulu untuk memulai kuis.</p>
            @endif
        </div>
    </div>
@endsection
