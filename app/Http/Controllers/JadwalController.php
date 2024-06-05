<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Projek;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function indexSupervisor($ids){
        $jadwalBelumSetuju = Jadwal::where('id_supervisor','=',$ids)->where('Status','=','Belum Disetujui')->get();
        $jadwalSetuju = Jadwal::where('id_supervisor','=',$ids)->where('Status','=','Disetujui')->get();
        $jadwal = Jadwal::where('id_supervisor','=',$ids)->get();
        $id = $ids;

        return view('jadwal.indexSupervisor', compact('jadwal','jadwalBelumSetuju','jadwalSetuju','id'));
    }

    public function createJadwal($id){
        $projek = Projek::where('id_supervisor','=',$id)->where('persen','!=','101')->get();
        $hari = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        return view('jadwal.create', compact('projek','hari','id'));        
    }

    public function storeSupervisor(Request $request, $ids)
    {
        //Validasi Formulir
        $this->validate($request, [
            'id_projek' => 'required',
            'hari' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required'    
        ]);

        if($request->waktu_mulai > $request->waktu_selesai){
            return redirect()->route('jadwal.indexSupervisor', compact('ids'))
            ->with(['error' => 'Waktu Mulai Jadwal Lebih Besar Dari Waktu Selesai']);
        }else{
            $data = Jadwal::where('hari','=',$request->hari)->Where('waktu_mulai','<=',$request->waktu_mulai)
            ->Where('waktu_selesai','>=',$request->waktu_mulai)->get();
            $cek = $data->count();

            if($cek!=0){
                return redirect()->route('jadwal.indexSupervisor', compact('ids'))
                ->with(['error' => 'Jadwal Pertemuan Bertabrakan Dengan Jadwal Yang Lain!!']);
            }else{
                $data = Jadwal::where('hari','=',$request->hari)->Where('waktu_mulai','<=',$request->waktu_selesai)
                ->Where('waktu_selesai','>=',$request->waktu_selesai)->get();
                $cek = $data->count();

                if($cek!=0){
                    return redirect()->route('jadwal.indexSupervisor', compact('ids'))
                    ->with(['error' => 'Jadwal Pertemuan Bertabrakan Dengan Jadwal Yang Lain!!']);
                }else{
                    $data = Jadwal::where('hari','=',$request->hari)->Where('waktu_mulai','>=',$request->waktu_mulai)
                    ->Where('waktu_selesai','<=',$request->waktu_selesai)->get();
                    $cek = $data->count();
                    if($cek!=0){
                        return redirect()->route('jadwal.indexSupervisor', compact('ids'))
                        ->with(['error' => 'Jadwal Pertemuan Bertabrakan Dengan Jadwal Yang Lain!!']);
                    }else{

                        $projek = Projek::where('id','=',$request->id_projek)->first();
                
                        //Fungsi Simpan Data ke dalam Database
                        Jadwal::create([
                            'id_supervisor' => $ids,
                            'id_tim' => $projek->id_tim,
                            'id_client' => $projek->id_client,
                            'id_projek' => $request->id_projek,
                            'hari' => $request->hari,
                            'waktu_mulai' => $request->waktu_mulai,
                            'waktu_selesai' => $request->waktu_selesai,
                            'status' => 'Belum Disetujui'
                        ]);
                            
                        return redirect()->route('jadwal.indexSupervisor', compact('ids'))
                        ->with(['success' => 'Jadwal Berhasil Ditambahkan']);
                    }
                }
            }
        }
    } 

    public function editJadwal($idj, $id){
        $projek = Projek::where('id_supervisor','=',$id)->where('persen','!=','101')->get();
        $hari = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        $jadwal = Jadwal::whereId($idj)->first();
        return view('jadwal.edit', compact('projek','hari','id'))->with('jadwal', $jadwal);
    }
    
    public function updateJadwalBySupervisor(Request $request, $idj, $ids){
        $this->validate($request, [
            'id_projek' => 'required',
            'hari' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required'             
        ]);

        if($request->waktu_mulai > $request->waktu_selesai){
            return redirect()->route('jadwal.indexSupervisor', compact('ids'))
            ->with(['error' => 'Waktu Mulai Jadwal Lebih Besar Dari Waktu Selesai']);
        }else{
            $data = Jadwal::where('id','!=',$idj)->where('hari','=',$request->hari)->Where('waktu_mulai','<=',$request->waktu_mulai)
            ->Where('waktu_selesai','>=',$request->waktu_mulai)->get();
            $cek = $data->count();

            if($cek!=0){
                return redirect()->route('jadwal.indexSupervisor', compact('ids'))
                ->with(['error' => 'Jadwal Pertemuan Bertabrakan Dengan Jadwal Yang Lain!!']);
            }else{
                $data = Jadwal::where('id','!=',$idj)->where('hari','=',$request->hari)->Where('waktu_mulai','<=',$request->waktu_selesai)
                ->Where('waktu_selesai','>=',$request->waktu_selesai)->get();
                $cek = $data->count();

                if($cek!=0){
                    return redirect()->route('jadwal.indexSupervisor', compact('ids'))
                    ->with(['error' => 'Jadwal Pertemuan Bertabrakan Dengan Jadwal Yang Lain!!']);
                }else{
                    $data = Jadwal::where('id','!=',$idj)->where('hari','=',$request->hari)
                    ->Where('waktu_mulai','>=',$request->waktu_mulai)->Where('waktu_selesai','<=',$request->waktu_selesai)->get();
                    $cek = $data->count();
                    if($cek!=0){
                        return redirect()->route('jadwal.indexSupervisor', compact('ids'))
                        ->with(['error' => 'Jadwal Pertemuan Bertabrakan Dengan Jadwal Yang Lain!!']);
                    }else{        
                        $projek = Projek::where('id','=',$request->id_projek)->first();
                        
                        $jadwal = Jadwal::whereId($idj)->first();
                        $jadwal->update([
                            'id_tim' => $projek->id_tim,
                            'id_client' => $projek->id_client,
                            'id_projek' => $request->id_projek,
                            'hari' => $request->hari,
                            'waktu_mulai' => $request->waktu_mulai,
                            'waktu_selesai' => $request->waktu_selesai
                        ]);
                
                        return redirect()->route('jadwal.indexSupervisor', compact('ids'))->with(['success' => 'Data Berhasil Diedit']);

                    }
                }
            }
        }
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
