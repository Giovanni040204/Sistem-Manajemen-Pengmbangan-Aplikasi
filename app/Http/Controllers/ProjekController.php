<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\AktivitasProjek;
use App\Models\Client;
use App\Models\ProgresProjek;
use App\Models\Projek;
use App\Models\Supervisor;
use App\Models\Tim;
use Carbon\Carbon;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        //Fungsi Simpan Data ke dalam Database
        Projek::create([
            'id_supervisor' => $id,
            'id_tim' => $request->id_tim,
            'id_client' => $request->id_client,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'Belum Konfirmasi',
            'persen' => -1,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        $projekBaru = Projek::where('judul','=',$request->judul)->first();

        $projek = Projek::where('id_supervisor','=',$id)->get();
        
        $sekarang = Carbon::now();

        AktivitasProjek::create([
            'id_projek' => $projekBaru->id,
            'tanggal' => $sekarang,
            'isi' => 'Projek dibuat oleh ' . $projekBaru->parentSupervisor->nama . ' dan menunggu konfirmasi dari ' . $projekBaru->parentTim->nama
        ]);

        $pesan = "<p>Sebuah projek sudah ditambahkan ke sistem oleh Supervisor dengan rincian :</p>";
        $pesan .= "<p><b>Judul : ".$projekBaru->judul."</b></p>";
        $pesan .= "<p><b>Deskripsi : ".$projekBaru->deskripsi."</b></p>";
        $pesan .= "<p><b>Supervisor : ".$projekBaru->parentSupervisor->nama."</b></p>";
        $pesan .= "<p><b>Tim : ".$projekBaru->parentTim->nama."</b></p>";
        $pesan .= "<p><b>Client : ".$projekBaru->parentClient->nama."</b></p>";
        $pesan .= "<p>Menunggu konfirmasi dari tim produksi pada sistem!!</p>";

        $data_email = [
            'subject' => 'Konfirmasi Projek',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($projekBaru->parentSupervisor->email)->send(new kirimEmail($data_email));
        Mail::to($projekBaru->parentTim->email)->send(new kirimEmail($data_email));
        Mail::to($projekBaru->parentClient->email)->send(new kirimEmail($data_email));

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
            'status' => 'Belum Konfirmasi',
            'persen' => 0
        ]);
            
        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Ditambahkan']);
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
                $projekSekarang = $projek;
                $id = $projek->id_tim;
                $projek = Projek::where('id_tim','=',$id)->get();

                $sekarang = Carbon::now();

                AktivitasProjek::create([
                    'id_projek' => $projekSekarang->id,
                    'tanggal' => $sekarang,
                    'isi' => 'PROJEK TELAH SELESAI'
                ]);

                $pesan = "<p>Status projek sudah Selesai Dikerjakan oleh Tim Produksi dengan rincian :</p>";
                $pesan .= "<p><b>Judul : ".$projekSekarang->judul."</b></p>";
                $pesan .= "<p><b>Deskripsi : ".$projekSekarang->deskripsi."</b></p>";
                $pesan .= "<p><b>Supervisor : ".$projekSekarang->parentSupervisor->nama."</b></p>";
                $pesan .= "<p><b>Tim : ".$projekSekarang->parentTim->nama."</b></p>";
                $pesan .= "<p><b>Client : ".$projekSekarang->parentClient->nama."</b></p>";

                $data_email = [
                    'subject' => 'Projek Selesai',
                    'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
                    'isi' => $pesan
                ];
                Mail::to($projekSekarang->parentSupervisor->email)->send(new kirimEmail($data_email));   
                Mail::to($projekSekarang->parentTim->email)->send(new kirimEmail($data_email));   
                Mail::to($projekSekarang->parentClient->email)->send(new kirimEmail($data_email)); 

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

        AktivitasProjek::create([
            'id_projek' => $projekSekarang->id,
            'tanggal' => $sekarang,
            'isi' => 'Persentase projek sudah ' . $projekSekarang->persen . '% pada tahap ' . $projekSekarang->status
        ]);

        $pesan = "<p>Status projek sudah diubah di sistem oleh Tim Produksi dengan rincian :</p>";
        $pesan .= "<p><b>Judul : ".$projekSekarang->judul."</b></p>";
        $pesan .= "<p><b>Deskripsi : ".$projekSekarang->deskripsi."</b></p>";
        $pesan .= "<p><b>Status : ".$projekSekarang->status."</b></p>";
        $pesan .= "<p><b>Progres : ".$projekSekarang->persen."%</b></p>";

        $data_email = [
            'subject' => 'Progres Projek',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($projekSekarang->parentSupervisor->email)->send(new kirimEmail($data_email));   
        Mail::to($projekSekarang->parentTim->email)->send(new kirimEmail($data_email));   
        Mail::to($projekSekarang->parentClient->email)->send(new kirimEmail($data_email));        

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
        $projekSekarang = $projek;
        $projek = Projek::where('id_supervisor','=',$id)->get();

        $sekarang = Carbon::now();

        AktivitasProjek::create([
            'id_projek' => $projekSekarang->id,
            'tanggal' => $sekarang,
            'isi' => 'Projek dibatalkan oleh ' . $projekSekarang->parentSupervisor->nama
        ]);

        $pesan = "<p>Sebuah projek DIBATALKAN oleh Supervisor dengan rincian :</p>";
        $pesan .= "<p><b>Judul : ".$projekSekarang->judul."</b></p>";
        $pesan .= "<p><b>Deskripsi : ".$projekSekarang->deskripsi."</b></p>";
        $pesan .= "<p><b>Supervisor : ".$projekSekarang->parentSupervisor->nama."</b></p>";
        $pesan .= "<p><b>Tim : ".$projekSekarang->parentTim->nama."</b></p>";
        $pesan .= "<p><b>Client : ".$projekSekarang->parentClient->nama."</b></p>";

        $data_email = [
            'subject' => 'Projek Dibatalkan',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($projekSekarang->parentSupervisor->email)->send(new kirimEmail($data_email));
        Mail::to($projekSekarang->parentTim->email)->send(new kirimEmail($data_email));
        Mail::to($projekSekarang->parentClient->email)->send(new kirimEmail($data_email));

        return redirect()->route('projek.indexbyidSupervisor', compact('projek','id'))->with(['success' => 'Projek Berhasil DIbatalkan']);
    } 
    
    public function projekSelesai(Request $request){
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('status','=', 'Selesai')->get();
        }else{
            $projek = Projek::where('status','=', 'Selesai')->get();
        }
        
        
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

    public function konfirmasiProjek($id, $idp){
        $projek = Projek::whereId($idp)->first();
        $projek->update(['status' => 'Requirement Definiton','persen' => 0]);

        $sekarang = Carbon::now();

        ProgresProjek::create([
            'id_projek' => $idp,
            'tanggal' => $sekarang,
            'persen' => 0
        ]);

        AktivitasProjek::create([
            'id_projek' => $idp,
            'tanggal' => $sekarang,
            'isi' => 'Projek sudah dikonfirmasi oleh ' . $projek->parentTim->nama
        ]);

        $pesan = "<p>Sebuah projek SUDAH DIKONFIRMASI oleh Tim Produksi dengan rincian :</p>";
        $pesan .= "<p><b>Judul : ".$projek->judul."</b></p>";
        $pesan .= "<p><b>Deskripsi : ".$projek->deskripsi."</b></p>";
        $pesan .= "<p><b>Supervisor : ".$projek->parentSupervisor->nama."</b></p>";
        $pesan .= "<p><b>Tim : ".$projek->parentTim->nama."</b></p>";
        $pesan .= "<p><b>Client : ".$projek->parentClient->nama."</b></p>";
        $pesan .= "<p>Mohon ditunggu email progres dari projek ini</p>";

        $data_email = [
            'subject' => 'Konfirmasi Projek',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($projek->parentSupervisor->email)->send(new kirimEmail($data_email));
        Mail::to($projek->parentTim->email)->send(new kirimEmail($data_email));
        Mail::to($projek->parentClient->email)->send(new kirimEmail($data_email));

        return redirect()->route('projek.indexbyidTim', compact('id'))->with(['success' => 'Projek berhasil dikonfirmasi']);
    }
}
