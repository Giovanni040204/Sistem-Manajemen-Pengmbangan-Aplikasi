<?php

namespace App\Http\Controllers;

use App\Models\ProgresProjek;
use App\Models\Projek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgresProjekController extends Controller
{
    public function indexSupervisor($id, $idp){
        $projek = Projek::where('id','=',$idp)->first();
        $data = ProgresProjek::select('tanggal', 'persen')->where('id_projek', '=', $idp)->get();
        
        $tanggal = ProgresProjek::select('tanggal')->get();

        return view('progresProjek.progresSupervisor', compact('projek','data','tanggal','id'));
    }

    public function indexTim($id, $idp){
        $projek = Projek::where('id','=',$idp)->first();
        $data = ProgresProjek::select('tanggal', 'persen')->where('id_projek', '=', $idp)->get();
        
        $tanggal = ProgresProjek::select('tanggal')->get();

        return view('progresProjek.progresTim', compact('projek','data','tanggal','id'));
    }

    public function indexClient($id, $idp){
        $projek = Projek::where('id','=',$idp)->first();
        $data = ProgresProjek::select('tanggal', 'persen')->where('id_projek', '=', $idp)->get();
        
        $tanggal = ProgresProjek::select('tanggal')->get();

        return view('progresProjek.progresClient', compact('projek','data','tanggal','id'));
    }

    public function indexAdmin($idp){
        $projek = Projek::where('id','=',$idp)->first();
        $data = ProgresProjek::select('tanggal', 'persen')->where('id_projek', '=', $idp)->get();
        
        $tanggal = ProgresProjek::select('tanggal')->get();

        return view('progresProjek.progresAdmin', compact('projek','data','tanggal'));
    }
}
