<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Projek;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function indexSupervisor($ids){
        $jadwal = Jadwal::where('id_supervisor','=',$ids)->get();
        $id = $ids;

        return view('jadwal.indexSupervisor', compact('jadwal','id'));
    }

    public function createJadwal($id){
        $projek = Projek::where('id_supervisor','=',$id)->where('persen','!=','101')->get();
        return view('jadwal.create', compact('projek', 'id'));        
    }

    public function storeSupervisor(Request $request, $ids)
    {
        //Validasi Formulir
        $this->validate($request, [
            'id_projek' => 'required',
            'topik' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required'        
        ]);

        $projek = Projek::where('id','=',$request->id_projek)->first();

        //Fungsi Simpan Data ke dalam Database
        Jadwal::create([
            'id_supervisor' => $ids,
            'id_tim' => $projek->id_tim,
            'id_projek' => $request->id_projek,
            'topik' => $request->topik,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'status' => 'Belum Disetujui'
        ]);
            
        return redirect()->route('jadwal.indexSupervisor', compact('ids'))->with(['success' => 'Pesan Terkirim']);
    } 

    public function editJadwal($idj, $id){
        $projek = Projek::where('id_supervisor','=',$id)->where('persen','!=','101')->get();
        $jadwal = Jadwal::whereId($idj)->first();
        return view('jadwal.edit', compact('projek','id'))->with('jadwal', $jadwal);
    }
    
    public function updateJadwalBySupervisor(Request $request, $idj, $ids){
        $this->validate($request, [
            'id_projek' => 'required',
            'topik' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required'            
        ]);
        
        $projek = Projek::where('id','=',$request->id_projek)->first();
        
        $jadwal = Jadwal::whereId($idj)->first();
        $jadwal->update([
            'id_tim' => $projek->id_tim,
            'id_projek' => $request->id_projek,
            'topik' => $request->topik,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('jadwal.indexSupervisor', compact('ids'))->with(['success' => 'Data Berhasil Diedit']);
    }    

    public function indexTim($idt){
        $jadwal = Jadwal::where('id_tim','=',$idt)->get();
        $id = $idt;

        return view('jadwal.indexTim', compact('jadwal','id'));
    }

    public function updateJadwalByTim($idj, $idt){
        
        $jadwal = Jadwal::whereId($idj)->first();
        $jadwal->update([
            'status' => 'Disetujui',
        ]);

        return redirect()->route('jadwal.indexTim', compact('idt'))->with(['success' => 'Data Berhasil Diubah']);
    } 
}
