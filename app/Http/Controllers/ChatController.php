<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function indexClient($idc, $idt, $idp){
        $chat = Chat::where('id_client','=',$idc)->where('id_tim','=',$idt)->where('id_projek','=',$idp)->get();
        $id = $idc;
        $cek = -1;

        return view('chat.indexClient', compact('chat','id','idc','idt','idp','cek'));
    }

    public function storeClient(Request $request, $idc, $idt, $idp)
    {
        //Validasi Formulir
        $this->validate($request, [
            'isi' => 'required',        
        ],[
            'isi.required'=>'Tidak boleh kosong',
        ]);

        $sekarang = Carbon::now();

        //Fungsi Simpan Data ke dalam Database
        Chat::create([
            'id_client' => $idc,
            'id_tim' => $idt,
            'id_projek' => $idp,
            'isi' => $request->isi,
            'tanggal' => $sekarang,
            'waktu' => $sekarang,
            'status' => 'Client',
        ]);
            
        return redirect()->route('chat.indexClient', compact('idc','idt','idp'))->with(['success' => 'Pesan Terkirim']);
    } 

    public function indexTim($idc, $idt, $idp){
        $chat = Chat::where('id_client','=',$idc)->where('id_tim','=',$idt)->where('id_projek','=',$idp)->get();
        $id = $idt;
        $cek = -1;

        return view('chat.indexTim', compact('chat','id','idc','idt','idp','cek'));
    }

    public function storeTim(Request $request, $idc, $idt, $idp)
    {
        //Validasi Formulir
        $this->validate($request, [
            'isi' => 'required'        
        ],[
            'isi.required'=>'Tidak boleh kosong',
        ]);

        $sekarang = Carbon::now();

        //Fungsi Simpan Data ke dalam Database
        Chat::create([
            'id_client' => $idc,
            'id_tim' => $idt,
            'id_projek' => $idp,
            'isi' => $request->isi,
            'tanggal' => $sekarang,
            'waktu' => $sekarang,
            'status' => 'Tim',
        ]);
            
        return redirect()->route('chat.indexTim', compact('idc','idt','idp'))->with(['success' => 'Pesan Terkirim']);
    } 
}
