<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ProgresProjek;
use App\Models\Projek;
use App\Models\Supervisor;
use App\Models\Tim;
use Carbon\Carbon;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProjekController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index(Request $request)
    {
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('persen','!=','101')->get();
        }else if($request->has('tahap')){
            $projek = Projek::where('status','LIKE','%'.$request->tahap.'%')->where('persen','!=','101')->get();
        }else{
            $projek = Projek::where('persen','!=','101')->get();
        }

        $status = ['Requirement Definiton','Design','Development','Intergration and Testing','Intallation and Acceptance'];
        //render view with posts
        return view('projek.index', compact('projek','status'));
    }

    public function indexbyidSupervisor(Request $request, $id)
    {
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('id_supervisor','=',$id)->where('persen','!=','101')->get();
        }else{
            $projek = Projek::where('id_supervisor','=',$id)->where('persen','!=','101')->get();
        }
        
        //render view with posts
        return view('projek.indexBySupervisor', compact('projek', 'id'));
    }

    public function indexbyidTim(Request $request, $id)
    {
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('id_tim','=',$id)->where('persen','!=','101')->get();
        }else{
            $projek = Projek::where('id_tim','=',$id)->where('persen','!=','101')->get();
        }
        //render view with posts
        return view('projek.indexByTim', compact('projek', 'id'));
    }   

    public function indexbyidClient(Request $request, $id)
    {
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('id_client','=',$id)->where('persen','!=','101')->get();
        }else{
            $projek = Projek::where('id_client','=',$id)->where('persen','!=','101')->get();
        }
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

        $projekBaru = Projek::where('judul','=',$request->judul)->first();
        $sekarang = Carbon::now();

        ProgresProjek::create([
            'id_projek' => $projekBaru->id,
            'tanggal' => $sekarang,
            'persen' => 0
        ]);

        $projek = Projek::where('id_supervisor','=',$id)->get();
        //render view with posts
        return redirect()->route('projek.indexbyidSupervisor', compact('projek','id'))->with(['success' => 'Data Berhasil Disimpan']);
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
                return redirect()->route('projek.indexbyidTim', compact('id'))->with(['error' => 'Persen harus dalam range 0% - 20%']);
            }
        }else if($request->status == 'Design'){
            if($request->persen < 20 || $request->persen > 40 ){
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                return redirect()->route('projek.indexbyidTim', compact('id'))->with(['error' => 'Persen harus dalam range 20% - 40%']);
            }
        }else if($request->status == 'Development'){
            if($request->persen < 40 || $request->persen > 60 ){
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                return redirect()->route('projek.indexbyidTim', compact('id'))->with(['error' => 'Persen harus dalam range 40% - 60%']);;
            }
        }else if($request->status == 'Intergration and Testing'){
            if($request->persen < 60 || $request->persen > 80 ){
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                return redirect()->route('projek.indexbyidTim', compact('id'))->with(['error' => 'Persen harus dalam range 60% - 80%']);;
            }
        }else if($request->status == 'Intallation and Acceptance'){
            if($request->persen < 80 || $request->persen > 100 ){
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                return redirect()->route('projek.indexbyidTim', compact('id'))->with(['error' => 'Persen harus dalam range 80% - 100%']);;
            }else if($request->persen == 100){
                $projek->update(['status' => 'Selesai','persen' => '101']);

                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();
                // return view('projek.indexByTim', compact('projek','id'))->with(['success' => 'Data Berhasil Diedit']);;
                return redirect()->route('projek.indexbyidTim', compact('id'))->with(['success' => 'PROJEK TELAH SELESAI']);
            }
        }

        $projek->update($request->all());

        $projekSekarang = $projek;

        $id = $projek->id_tim;
        $projek = Projek::where('id_tim','=',$id)->get();
        
        $sekarang = Carbon::now();

        ProgresProjek::create([
            'id_projek' => $projekSekarang->id,
            'tanggal' => $sekarang,
            'persen' => $projekSekarang->persen
        ]);

        return redirect()->route('projek.indexbyidTim', compact('id'))->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $projek = Projek::whereId($id)->first();

        Projek::find($id)->delete();

        $id = $projek->id_supervisor;
        $projek = Projek::where('id_supervisor','=',$id)->get();

        return redirect()->route('projek.indexbyidSupervisor', compact('projek','id'))->with(['success' => 'Projek Berhasil DIbatalkan']);
    } 

    public function batalProjek($id)
    {
        $projek = Projek::whereId($id)->first();

        $projek->update(['status' => 'Batal','persen' => '101']);

        $id = $projek->id_supervisor;
        $projek = Projek::where('id_supervisor','=',$id)->get();

        return redirect()->route('projek.indexbyidSupervisor', compact('projek','id'))->with(['success' => 'Projek Berhasil DIbatalkan']);
    } 
    
    public function projekSelesai(Request $request){
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('status','=', 'Selesai')->get();
        }else{
            $projek = Projek::where('status','=', 'Selesai')->get();
        }
        
        //render view with posts
        return view('projek.projekSelesai', compact('projek'));
    }

    public function projekBatal(Request $request){
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('status','=', 'Batal')->get();
        }else{
            $projek = Projek::where('status','=', 'Batal')->get();
        }
        
        //render view with posts
        return view('projek.projekBatal', compact('projek'));
    }

    public function historySupervisor(Request $request, $id){
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('id_supervisor','=', $id)->where('persen','=', '101')->get();
        }else{
            $projek = Projek::where('id_supervisor','=', $id)->where('persen','=', '101')->get();
        }
        
        return view('supervisor.historySupervisor', compact('projek','id'));
    }

    public function historyTim(Request $request, $id){
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('id_tim','=', $id)->where('persen','=', '101')->get();
        }else{
            $projek = Projek::where('id_tim','=', $id)->where('persen','=', '101')->get();
        }
        
        //render view with posts
        return view('tim.historyTim', compact('projek','id'));
    }

    public function historyClient(Request $request, $id){
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('id_client','=', $id)->where('persen','=', '101')->get();
        }else{
            $projek = Projek::where('id_client','=', $id)->where('persen','=', '101')->get();
        }
        
        //render view with posts
        return view('client.historyClient', compact('projek','id'));
    }
}
