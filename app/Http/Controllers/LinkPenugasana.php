<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkPenugasan;

class LinkPenugasana extends Controller
{
    public function delete($id){
        $deleteData = LinkPenugasan::findOrFail($id);
        $deleteData->delete();

        return redirect()->back()->with('success', 'Link penugasan berhasil dihapus.');
    }

    public function update(Request $req, $id){
        // dd($req->all());
        
        $penugasan = LinkPenugasan::findOrFail($id);
        $penugasan->update([
            'nama_penugasan' => $req->judul_materi,
            'link_penugasan' => $req->link_gform,
        ]);

        return redirect()->back()->with('success', 'Link penugasan berhasil diperbarui.');
    }

    public function store(Request $req){
        // dd($req->all());
        
        LinkPenugasan::create([
            'nama_penugasan' => $req->judul_materi,
            'link_penugasan' => $req->link_gform,
        ]);

        return redirect()->back()->with('success', 'Link penugasan berhasil disimpan.');
    }

    public function index(){
        $getAllPenugasan = LinkPenugasan::all()->sortByDesc('created_at');
        return view('penugasan.index', compact('getAllPenugasan'));
    }
}
