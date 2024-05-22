<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\Evaluasi;
use App\Models\Projek;
use App\Models\Supervisor;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EvaluasiController extends Controller
{
    public function index(Request $request, $id)
    {
        if($request->has('search')){
            $projek = Projek::where('judul','LIKE','%'.$request->search.'%')->where('id_client','=',$id)->where('status','=','Selesai')->get();
        }else{
            $projek = Projek::where('id_client','=',$id)->where('status','=','Selesai')->get();
        }
        
        //render view with posts
        return view('evaluasi.index', compact('projek', 'id'));
    }

    public function indexClient(Request $request, $id, $idp)
    {
        $data = Evaluasi::where('id_projek','=',$idp)->get();
        $cek = $data->count();
        if($cek==0){
            return redirect()->route('evaluasi.create', compact('id','idp'));
        }
        $evaluasi = Evaluasi::where('id_projek','=',$idp)->first();
        
        return view('evaluasi.indexClient', compact('evaluasi', 'id'));
    }

    public function indexSupervisor(Request $request, $id, $idp)
    {
        $data = Evaluasi::where('id_projek','=',$idp)->get();
        $cek = $data->count();
        if($cek==0){
            return redirect()->route('projek.historySupervisor', compact('id'))->with(['error' => 'Evaluasi Belum Diisi Oleh Klien']);
        }
        $evaluasi = Evaluasi::where('id_projek','=',$idp)->first();
        
        return view('evaluasi.indexSupervisor', compact('evaluasi', 'id'));
    }

    public function indexTim(Request $request, $id, $idp)
    {
        $data = Evaluasi::where('id_projek','=',$idp)->get();
        $cek = $data->count();
        if($cek==0){
            return redirect()->route('projek.historyTim', compact('id'))->with(['error' => 'Evaluasi Belum Diisi Oleh Klien']);
        }
        $evaluasi = Evaluasi::where('id_projek','=',$idp)->first();
        
        return view('evaluasi.indexTim', compact('evaluasi', 'id'));
    }

    public function indexAdmin(Request $request, $idp)
    {
        $data = Evaluasi::where('id_projek','=',$idp)->get();
        $cek = $data->count();
        if($cek==0){
            return redirect()->route('projek.projekSelesai')->with(['error' => 'Evaluasi Belum Diisi Oleh Klien']);
        }
        $evaluasi = Evaluasi::where('id_projek','=',$idp)->first();
        
        return view('evaluasi.indexAdmin', compact('evaluasi'));
    }

    public function create($id, $idp){
        $projek = Projek::whereId($idp)->first();
        return view('evaluasi.create', compact('projek','id'));
    }

    public function store(Request $request, $id, $idp)
    {
        //Validasi Formulir
        $this->validate($request, [
            'isi' => 'required',         
        ]);

        //Fungsi Simpan Data ke dalam Database
        Evaluasi::create([
            'id_projek' => $idp,
            'isi' => $request->isi,
        ]);

        $projek = Projek::where('id','=',$idp)->first();
        $supervisor = Supervisor::where('id','=',$projek->parentSupervisor->id)->first();
        $tim = Tim::where('id','=',$projek->parentTim->id)->first();

        $pesan = "<p>Client sudah mengisi Evaluasi Projek dengan rincian :</p>";
        $pesan .= "<p><b>Judul : ".$projek->judul."</b></p>";
        $pesan .= "<p><b>Deskripsi : ".$projek->deskripsi."</b></p>";
        $pesan .= "<p><b>Supervisor : ".$projek->parentSupervisor->nama."</b></p>";
        $pesan .= "<p><b>Tim : ".$projek->parentTim->nama."</b></p>";
        $pesan .= "<p><b>Client : ".$projek->parentClient->nama."</b></p>";
        $pesan .= "<p>Silahkan mengecek isi evaluasi melalui sistem</p>";

        $data_email = [
            'subject' => 'Evaluasi Projek',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($supervisor->email)->send(new kirimEmail($data_email));
        Mail::to($tim->email)->send(new kirimEmail($data_email));
            
        return redirect()->route('projek.historyClient', compact('id'))->with(['success' => 'Evaluasi Berhasil Ditambahkan']);
    }


}
