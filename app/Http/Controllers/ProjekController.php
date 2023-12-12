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

    public function indexbyidClient($id)
    {
        $projek = Projek::where('id_client','=',$id)->get();
        //render view with posts
        return view('projek.indexByClient', compact('projek', 'id'));
    }     

    public function createProjek($id){
        $supervisor = Supervisor::whereId($id)->first();
        $client = Client::all();
        $tim = Tim::all();
        return view('projek.create', compact('supervisor','client','tim','id'));
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
        $id = $projek->id_tim;
        
        return view('projek.edit', compact('status','id'))->with('projek', $projek);
    } 

    public function update(Request $request, $id){
        $this->validate($request, [
            'status' => 'required',
            'persen' => 'required',
        ]);

        $projek = Projek::whereId($id)->first();

        if($request->status == 'Requirement Definiton'){
            if($request->persen < 0 || $request->persen > 20 ){
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                return redirect()->route('projek.indexbyidTim', compact('id'))->with(['errors' => 'Persen harus dalam range 0% - 20%']);
            }
        }else if($request->status == 'Design'){
            if($request->persen < 20 || $request->persen > 40 ){
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                return view('projek.indexByTim', compact('projek','id'))->with(['error' => 'Persen harus dalam range 20% - 40%']);;
            }
        }else if($request->status == 'Development'){
            if($request->persen < 40 || $request->persen > 60 ){
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                return view('projek.indexByTim', compact('projek','id'))->with(['error' => 'Persen harus dalam range 40% - 60%']);;
            }
        }else if($request->status == 'Intergration and Testing'){
            if($request->persen < 60 || $request->persen > 80 ){
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                return view('projek.indexByTim', compact('projek','id'))->with(['error' => 'Persen harus dalam range 60% - 80%']);;
            }
        }else if($request->status == 'Intallation and Acceptance'){
            if($request->persen < 80 || $request->persen > 100 ){
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                return view('projek.indexByTim', compact('projek','id'))->with(['error' => 'Persen harus dalam range 80% - 100%']);;
            }
        }

        $projek->update($request->all());


        $id = $projek->id_tim;
        $projek = Projek::where('id_tim','=',$id)->get();
        // return view('projek.indexByTim', compact('projek','id'))->with(['success' => 'Data Berhasil Diedit']);;
        return redirect()->route('projek.indexbyidTim', compact('id'))->with(['success' => 'Data Berhasil Diedit']);
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
