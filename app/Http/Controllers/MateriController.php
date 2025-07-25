<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelMateri;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function show($id){
        $materi = ModelMateri::findOrFail($id);
        // \dd($materi);
        return view('materi.show.index', compact('materi'));
    }
    public function edit(Request $request){
        // \dd($request->all());
        $materi = ModelMateri::findOrFail($request->id);
        // \dd($materi);
        $materi->update([
            'title' => request('title'),
            'link_materi' => request('link_materi'),
            'tipe' => request('tipe'),
            'tipe_belajar' => request('tipe_belajar'),
            'link_gform' => request('link_gform'),
        ]);
        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function delete($id){
        $materi = ModelMateri::findOrFail($id);
        $materi->delete();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus!');
    }

    public function store(Request $request){
        // Validasi input
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'tipe_materi' => 'required|in:video,file',
            'link_materi' => 'url|nullable',
            'link_video' => 'url|nullable',
            'link_gform' => 'nullable|url',
            'tipe_ajaran' => 'required|in:auditori,kinestetik,visual',
        ]);
        // \dd($request->all());

        $linkMateri = $request->link_materi ?? $request->link_video;
        ModelMateri::create([
            'title' => $request->judul_materi,
            'link_materi' => $linkMateri,
            'tipe' => $request->tipe_materi,
            'tipe_belajar' => $request->tipe_ajaran,
            'link_gform' => $request->link_gform,
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function index(){
        $getMinatUser = Auth::user()->minat;
        // dd($getMinatUser);
        $getAllMateri = ModelMateri::orderBy('created_at', 'desc')->get();
        $getMateriAudio = ModelMateri::where('tipe_belajar', 'auditori')->get();
        $getMateriVisual = ModelMateri::where('tipe_belajar', 'visual')->get();
        $getMateriKinestetik = ModelMateri::where('tipe_belajar', 'kinestetik')->get();

        $getMateriUser = ModelMateri::where('tipe_belajar', $getMinatUser)->get();
        // dd($getMateriUser);

        $countMateriAudio = $getMateriAudio->count();
        $countMateriVisual = $getMateriVisual->count();
        $countMateriKinestetik = $getMateriKinestetik->count();
        $countAllMateri = $getAllMateri->count();

        return view('materi.index', compact('getAllMateri', 'getMateriAudio', 'getMateriVisual', 'getMateriKinestetik', 'countAllMateri', 'countMateriAudio', 'countMateriVisual', 'countMateriKinestetik', 'getMateriUser'));
    }
}
