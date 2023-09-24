<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Projek;
use App\Models\Supervisor;
use App\Models\Tim;
use Illuminate\Http\Request;

class ProjekController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get posts
        $projek = Projek::get();

        //render view with posts
        return view('projek.index', compact('projek'));
    }

    public function indexbyidSupervisor($id)
    {
        $projek = Projek::where('id_supervisor','=',$id)->get();
        //render view with posts
        return view('projek.indexBySupervisor', compact('projek', 'id'));
    }

    public function indexbyidTim($id)
    {
        $projek = Projek::where('id_tim','=',$id)->get();
        //render view with posts
        return view('projek.indexByTim', compact('projek', 'id'));
    }    

    public function createProjek($id){
        $supervisor = Supervisor::whereId($id)->first();
        $client = Client::all();
        $tim = Tim::all();
        return view('projek.create', compact('supervisor','client','tim'));
        // return view('projek.create')->with('supervisor', $supervisor);
    }

    public function storeProjek(Request $request, $id){
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'id_client' => 'required',
            'id_tim' => 'required',
        ]);

        //Fungsi Simpan Data ke dalam Database
        Projek::create([
            'id_supervisor' => $id,
            'id_tim' => $request->id_tim,
            'id_client' => $request->id_client,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'Requirement Definiton',
            'persen' => 0
        ]);

        $projek = Projek::where('id_supervisor','=',$id)->get();
        //render view with posts
        return view('projek.indexBySupervisor', compact('projek','id'))->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function create()
    {
        return view('projek.create');
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        //Fungsi Simpan Data ke dalam Database
        Projek::create([
            'id_user' => 0,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'Requirement Definiton',
            'persen' => 0
        ]);
            
        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Disimpan']);
    }    

    public function edit($id){
        $projek = Projek::whereId($id)->first();
        $status = ['Requirement Definiton','Design','Development','Intergration and Testing','Intallation and Acceptance'];
        
        return view('projek.edit', compact('status'))->with('projek', $projek);
    } 

    public function update(Request $request, $id){
        $projek = Projek::whereId($id)->first();
        $projek->update($request->all());


        $id = $projek->id_tim;
        $projek = Projek::where('id_tim','=',$id)->get();
        return view('projek.indexByTim', compact('projek','id'))->with(['success' => 'Data Berhasil Diedit']);;
    }

    public function destroy($id)
    {
        $projek = Projek::whereId($id)->first();

        Projek::find($id)->delete();

        $id = $projek->id_supervisor;
        $projek = Projek::where('id_supervisor','=',$id)->get();

        return view('projek.indexBySupervisor', compact('projek','id'))->with(['success' => 'Data Berhasil Dihapus']);
    }    
}
