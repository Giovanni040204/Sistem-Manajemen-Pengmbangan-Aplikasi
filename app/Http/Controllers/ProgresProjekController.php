<?php

namespace App\Http\Controllers;

use App\Models\ProgresProjek;
use App\Models\Projek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgresProjekController extends Controller
{
    public function index($id, $idp){
        $projek = Projek::where('id','=',$idp)->first();
        $data = ProgresProjek::select('tanggal', 'persen')->where('id_projek', '=', $idp)->get();
        // dd($data->toArray()); // Cek data yang diterima
        
        $tanggal = ProgresProjek::select('tanggal')->get();

        return view('progresProjek.progres', compact('projek','data','tanggal','id'));
    }
}
