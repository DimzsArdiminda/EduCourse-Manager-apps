<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function store(Request $request){
        \dd($request->all());
    }
    
    public function index(){
        return view('materi.index');
    }
}
