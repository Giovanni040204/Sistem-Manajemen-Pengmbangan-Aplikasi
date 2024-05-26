<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JadwalPertemuan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalPertemuanController extends Controller
{
    public function indexSupervisor($ids){
        $jadwalPertemuan = JadwalPertemuan::where('id_supervisor','=',$ids)->get();
        $id = $ids;

        $jumlah = $jadwalPertemuan->count();

        $senin = 0;
        $selasa = 0;
        $rabu = 0;
        $kamis = 0;
        $jumat = 0;
        $sabtu = 0;
        $minggu = 0;

        $banyak = 0;
        $cek = 0;  

        for($i=0;$i<$jumlah;$i++){
            if($jadwalPertemuan[$i]->hari == 'Senin'){
                $senin++;
                if($senin > $banyak){
                    $banyak = $senin;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Selasa'){
                $selasa++;
                if($selasa > $banyak){
                    $banyak = $selasa;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Rabu'){
                $rabu++;
                if($rabu > $banyak){
                    $banyak = $rabu;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Kamis'){
                $kamis++;
                if($kamis > $banyak){
                    $banyak = $kamis;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Jumat'){
                $jumat++;
                if($jumat > $banyak){
                    $banyak = $jumat;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Sabtu'){
                $sabtu++;
                if($sabtu > $banyak){
                    $banyak = $sabtu;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Minggu'){
                $minggu++;
                if($minggu > $banyak){
                    $banyak = $minggu;
                }
            }
        }

        $today = Carbon::now();

        if($today->isMonday()){
            $tanggal1 = date('d-m-Y', strtotime($today));
            $tanggal2 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+6 day', strtotime($today)));
        }else if($today->isTuesday()){
            $tanggal1 = date('d-m-Y', strtotime('-1 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime($today));
            $tanggal3 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+5 day', strtotime($today)));
        }else if($today->isWednesday()){
            $tanggal1 = date('d-m-Y', strtotime('-2 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime($today)); 
            $tanggal4 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+4 day', strtotime($today)));
        }elseif($today->isThursday()){
            $tanggal1 = date('d-m-Y', strtotime('-3 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-2 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime($today)); 
            $tanggal5 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+3 day', strtotime($today)));
        }else if($today->isFriday()){
            $tanggal1 = date('d-m-Y', strtotime('-4 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-3 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('-2 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime($today)); 
            $tanggal6 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+2 day', strtotime($today)));
        }else if($today->isSaturday()){
            $tanggal1 = date('d-m-Y', strtotime('+2 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+6 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime($today));
            $tanggal7 = date('d-m-Y', strtotime('+1 day', strtotime($today)));
        }else if($today->isSunday()){
            $tanggal1 = date('d-m-Y', strtotime('+1 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+6 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime($today));
        }

        $tanggal = [$tanggal1,$tanggal2,$tanggal3,$tanggal4,$tanggal5,$tanggal6,$tanggal7];
        $ganti=0;

        return view('jadwalPertemuan.indexSupervisor', compact('jadwalPertemuan','id','ganti','banyak','cek','tanggal','jumlah'));        
    }

    public function indexTim($idt){
        $jadwalPertemuan = JadwalPertemuan::where('id_tim','=',$idt)->get();
        $id = $idt;

        $jumlah = $jadwalPertemuan->count();

        $senin = 0;
        $selasa = 0;
        $rabu = 0;
        $kamis = 0;
        $jumat = 0;
        $sabtu = 0;
        $minggu = 0;

        $banyak = 0;
        $cek = 0;  

        for($i=0;$i<$jumlah;$i++){
            if($jadwalPertemuan[$i]->hari == 'Senin'){
                $senin++;
                if($senin > $banyak){
                    $banyak = $senin;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Selasa'){
                $selasa++;
                if($selasa > $banyak){
                    $banyak = $selasa;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Rabu'){
                $rabu++;
                if($rabu > $banyak){
                    $banyak = $rabu;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Kamis'){
                $kamis++;
                if($kamis > $banyak){
                    $banyak = $kamis;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Jumat'){
                $jumat++;
                if($jumat > $banyak){
                    $banyak = $jumat;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Sabtu'){
                $sabtu++;
                if($sabtu > $banyak){
                    $banyak = $sabtu;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Minggu'){
                $minggu++;
                if($minggu > $banyak){
                    $banyak = $minggu;
                }
            }
        }

        $today = Carbon::now();

        if($today->isMonday()){
            $tanggal1 = date('d-m-Y', strtotime($today));
            $tanggal2 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+6 day', strtotime($today)));
        }else if($today->isTuesday()){
            $tanggal1 = date('d-m-Y', strtotime('-1 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime($today));
            $tanggal3 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+5 day', strtotime($today)));
        }else if($today->isWednesday()){
            $tanggal1 = date('d-m-Y', strtotime('-2 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime($today));
            $tanggal4 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+4 day', strtotime($today)));
        }elseif($today->isThursday()){
            $tanggal1 = date('d-m-Y', strtotime('-3 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-2 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime($today));
            $tanggal5 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+3 day', strtotime($today)));
        }else if($today->isFriday()){
            $tanggal1 = date('d-m-Y', strtotime('-4 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-3 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('-2 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime($today));
            $tanggal6 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+2 day', strtotime($today)));
        }else if($today->isSaturday()){
            $tanggal1 = date('d-m-Y', strtotime('+2 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+6 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime($today));
            $tanggal7 = date('d-m-Y', strtotime('+1 day', strtotime($today)));
        }else if($today->isSunday()){
            $tanggal1 = date('d-m-Y', strtotime('+1 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+6 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime($today));
        }

        $tanggal = [$tanggal1,$tanggal2,$tanggal3,$tanggal4,$tanggal5,$tanggal6,$tanggal7];
        $ganti=0;

        return view('jadwalPertemuan.indexTim', compact('jadwalPertemuan','id','ganti','banyak','cek','tanggal','jumlah'));        
    }

    public function indexClient($idc){
        $jadwalPertemuan = JadwalPertemuan::where('id_client','=',$idc)->get();
        $id = $idc;

        $jumlah = $jadwalPertemuan->count();

        $senin = 0;
        $selasa = 0;
        $rabu = 0;
        $kamis = 0;
        $jumat = 0;
        $sabtu = 0;
        $minggu = 0;

        $banyak = 0;
        $cek = 0;  

        for($i=0;$i<$jumlah;$i++){
            if($jadwalPertemuan[$i]->hari == 'Senin'){
                $senin++;
                if($senin > $banyak){
                    $banyak = $senin;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Selasa'){
                $selasa++;
                if($selasa > $banyak){
                    $banyak = $selasa;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Rabu'){
                $rabu++;
                if($rabu > $banyak){
                    $banyak = $rabu;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Kamis'){
                $kamis++;
                if($kamis > $banyak){
                    $banyak = $kamis;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Jumat'){
                $jumat++;
                if($jumat > $banyak){
                    $banyak = $jumat;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Sabtu'){
                $sabtu++;
                if($sabtu > $banyak){
                    $banyak = $sabtu;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Minggu'){
                $minggu++;
                if($minggu > $banyak){
                    $banyak = $minggu;
                }
            }
        }

        $today = Carbon::now();

        if($today->isMonday()){
            $tanggal1 = date('d-m-Y', strtotime($today));
            $tanggal2 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+6 day', strtotime($today)));
        }else if($today->isTuesday()){
            $tanggal1 = date('d-m-Y', strtotime('-1 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime($today));
            $tanggal3 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+5 day', strtotime($today)));
        }else if($today->isWednesday()){
            $tanggal1 = date('d-m-Y', strtotime('-2 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime($today)); 
            $tanggal4 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+4 day', strtotime($today)));
        }elseif($today->isThursday()){
            $tanggal1 = date('d-m-Y', strtotime('-3 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-2 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime($today));
            $tanggal5 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+3 day', strtotime($today)));
        }else if($today->isFriday()){
            $tanggal1 = date('d-m-Y', strtotime('-4 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-3 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('-2 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime($today)); 
            $tanggal6 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+2 day', strtotime($today)));
        }else if($today->isSaturday()){
            $tanggal1 = date('d-m-Y', strtotime('+2 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+6 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime($today));
            $tanggal7 = date('d-m-Y', strtotime('+1 day', strtotime($today)));
        }else if($today->isSunday()){
            $tanggal1 = date('d-m-Y', strtotime('+1 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+6 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime($today));
        }

        $tanggal = [$tanggal1,$tanggal2,$tanggal3,$tanggal4,$tanggal5,$tanggal6,$tanggal7];
        $ganti=0;

        return view('jadwalPertemuan.indexClient', compact('jadwalPertemuan','id','ganti','banyak','cek','tanggal','jumlah'));        
    }

    public function indexAdmin(){
        $jadwalPertemuan = JadwalPertemuan::all();

        $jumlah = $jadwalPertemuan->count();

        $senin = 0;
        $selasa = 0;
        $rabu = 0;
        $kamis = 0;
        $jumat = 0;
        $sabtu = 0;
        $minggu = 0;

        $banyak = 0;
        $cek = 0;  

        for($i=0;$i<$jumlah;$i++){
            if($jadwalPertemuan[$i]->hari == 'Senin'){
                $senin++;
                if($senin > $banyak){
                    $banyak = $senin;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Selasa'){
                $selasa++;
                if($selasa > $banyak){
                    $banyak = $selasa;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Rabu'){
                $rabu++;
                if($rabu > $banyak){
                    $banyak = $rabu;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Kamis'){
                $kamis++;
                if($kamis > $banyak){
                    $banyak = $kamis;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Jumat'){
                $jumat++;
                if($jumat > $banyak){
                    $banyak = $jumat;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Sabtu'){
                $sabtu++;
                if($sabtu > $banyak){
                    $banyak = $sabtu;
                }
            }else if($jadwalPertemuan[$i]->hari == 'Minggu'){
                $minggu++;
                if($minggu > $banyak){
                    $banyak = $minggu;
                }
            }
        }

        $today = Carbon::now();

        if($today->isMonday()){
            $tanggal1 = date('d-m-Y', strtotime($today));
            $tanggal2 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+6 day', strtotime($today)));
        }else if($today->isTuesday()){
            $tanggal1 = date('d-m-Y', strtotime('-1 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime($today));
            $tanggal3 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+5 day', strtotime($today)));
        }else if($today->isWednesday()){
            $tanggal1 = date('d-m-Y', strtotime('-2 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime($today)); 
            $tanggal4 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+4 day', strtotime($today)));
        }elseif($today->isThursday()){
            $tanggal1 = date('d-m-Y', strtotime('-3 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-2 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime($today)); 
            $tanggal5 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+3 day', strtotime($today)));
        }else if($today->isFriday()){
            $tanggal1 = date('d-m-Y', strtotime('-4 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('-3 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('-2 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('-1 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime($today));
            $tanggal6 = date('d-m-Y', strtotime('+1 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime('+2 day', strtotime($today)));
        }else if($today->isSaturday()){
            $tanggal1 = date('d-m-Y', strtotime('+2 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+6 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime($today));
            $tanggal7 = date('d-m-Y', strtotime('+1 day', strtotime($today)));
        }else if($today->isSunday()){
            $tanggal1 = date('d-m-Y', strtotime('+1 day', strtotime($today)));
            $tanggal2 = date('d-m-Y', strtotime('+2 day', strtotime($today))); 
            $tanggal3 = date('d-m-Y', strtotime('+3 day', strtotime($today))); 
            $tanggal4 = date('d-m-Y', strtotime('+4 day', strtotime($today))); 
            $tanggal5 = date('d-m-Y', strtotime('+5 day', strtotime($today))); 
            $tanggal6 = date('d-m-Y', strtotime('+6 day', strtotime($today))); 
            $tanggal7 = date('d-m-Y', strtotime($today));
        }

        $tanggal = [$tanggal1,$tanggal2,$tanggal3,$tanggal4,$tanggal5];
        $ganti=0;

        return view('jadwalPertemuan.indexAdmin', compact('jadwalPertemuan','ganti','banyak','cek','tanggal','jumlah'));        
    }

    public function store($ids){
        $jadwalSetuju = Jadwal::where('id_supervisor','=',$ids)->where('Status','=','Disetujui')->get();

        $jumlah = $jadwalSetuju->count(); 
        
        if($jumlah==0){
            return redirect()->route('jadwal.indexSupervisor', compact('ids'))->with(['error' => 'Tidak Ada Jadwal Yang Di Generate']);
        }

        $today = Carbon::now();

        if($today->isMonday()){
            $tanggal1 = date('Y-m-d', strtotime($today));
            $tanggal2 = date('Y-m-d', strtotime('+1 day', strtotime($today))); 
            $tanggal3 = date('Y-m-d', strtotime('+2 day', strtotime($today))); 
            $tanggal4 = date('Y-m-d', strtotime('+3 day', strtotime($today))); 
            $tanggal5 = date('Y-m-d', strtotime('+4 day', strtotime($today))); 
            $tanggal6 = date('Y-m-d', strtotime('+5 day', strtotime($today))); 
            $tanggal7 = date('Y-m-d', strtotime('+6 day', strtotime($today)));
        }else if($today->isTuesday()){
            $tanggal1 = date('Y-m-d', strtotime('-1 day', strtotime($today)));
            $tanggal2 = date('Y-m-d', strtotime($today));
            $tanggal3 = date('Y-m-d', strtotime('+1 day', strtotime($today))); 
            $tanggal4 = date('Y-m-d', strtotime('+2 day', strtotime($today))); 
            $tanggal5 = date('Y-m-d', strtotime('+3 day', strtotime($today))); 
            $tanggal6 = date('Y-m-d', strtotime('+4 day', strtotime($today))); 
            $tanggal7 = date('Y-m-d', strtotime('+5 day', strtotime($today)));
        }else if($today->isWednesday()){
            $tanggal1 = date('Y-m-d', strtotime('-2 day', strtotime($today)));
            $tanggal2 = date('Y-m-d', strtotime('-1 day', strtotime($today))); 
            $tanggal3 = date('Y-m-d', strtotime($today)); 
            $tanggal4 = date('Y-m-d', strtotime('+1 day', strtotime($today))); 
            $tanggal5 = date('Y-m-d', strtotime('+2 day', strtotime($today))); 
            $tanggal6 = date('Y-m-d', strtotime('+3 day', strtotime($today))); 
            $tanggal7 = date('Y-m-d', strtotime('+4 day', strtotime($today)));
        }elseif($today->isThursday()){
            $tanggal1 = date('Y-m-d', strtotime('-3 day', strtotime($today)));
            $tanggal2 = date('Y-m-d', strtotime('-2 day', strtotime($today))); 
            $tanggal3 = date('Y-m-d', strtotime('-1 day', strtotime($today))); 
            $tanggal4 = date('Y-m-d', strtotime($today));
            $tanggal5 = date('Y-m-d', strtotime('+1 day', strtotime($today))); 
            $tanggal6 = date('Y-m-d', strtotime('+2 day', strtotime($today))); 
            $tanggal7 = date('Y-m-d', strtotime('+3 day', strtotime($today)));
        }else if($today->isFriday()){
            $tanggal1 = date('Y-m-d', strtotime('-4 day', strtotime($today)));
            $tanggal2 = date('Y-m-d', strtotime('-3 day', strtotime($today))); 
            $tanggal3 = date('Y-m-d', strtotime('-2 day', strtotime($today))); 
            $tanggal4 = date('Y-m-d', strtotime('-1 day', strtotime($today))); 
            $tanggal5 = date('Y-m-d', strtotime($today));
            $tanggal6 = date('Y-m-d', strtotime('+1 day', strtotime($today))); 
            $tanggal7 = date('Y-m-d', strtotime('+2 day', strtotime($today)));
        }else if($today->isSaturday()){
            $tanggal1 = date('Y-m-d', strtotime('-5 day', strtotime($today)));
            $tanggal2 = date('Y-m-d', strtotime('-4 day', strtotime($today))); 
            $tanggal3 = date('Y-m-d', strtotime('-3 day', strtotime($today))); 
            $tanggal4 = date('Y-m-d', strtotime('-2 day', strtotime($today))); 
            $tanggal5 = date('Y-m-d', strtotime('-1 day', strtotime($today))); 
            $tanggal6 = date('Y-m-d', strtotime($today));
            $tanggal7 = date('Y-m-d', strtotime('+1 day', strtotime($today)));
        }else if($today->isSunday()){
            $tanggal1 = date('Y-m-d', strtotime('-6 day', strtotime($today)));
            $tanggal2 = date('Y-m-d', strtotime('-5 day', strtotime($today))); 
            $tanggal3 = date('Y-m-d', strtotime('-4 day', strtotime($today))); 
            $tanggal4 = date('Y-m-d', strtotime('-3 day', strtotime($today))); 
            $tanggal5 = date('Y-m-d', strtotime('-2 day', strtotime($today))); 
            $tanggal6 = date('Y-m-d', strtotime('-1 day', strtotime($today))); 
            $tanggal7 = date('Y-m-d', strtotime($today));
        }        
        
        for($i=0;$i<$jumlah;$i++){

            if($jadwalSetuju[$i]->hari == 'Senin'){
                $tanggal = $tanggal1;
            }else if($jadwalSetuju[$i]->hari == 'Selasa'){
                $tanggal = $tanggal2;
            }else if($jadwalSetuju[$i]->hari == 'Rabu'){
                $tanggal = $tanggal3;
            }else if($jadwalSetuju[$i]->hari == 'Kamis'){
                $tanggal = $tanggal4;
            }else if($jadwalSetuju[$i]->hari == 'Jumat'){
                $tanggal = $tanggal5;
            }

            JadwalPertemuan::create([
                'id_supervisor' => $ids,
                'id_tim' => $jadwalSetuju[$i]->id_tim,
                'id_client' => $jadwalSetuju[$i]->id_client,
                'id_projek' => $jadwalSetuju[$i]->id_projek,
                'hari' => $jadwalSetuju[$i]->hari,
                'tanggal' => $tanggal,
                'waktu_mulai' => $jadwalSetuju[$i]->waktu_mulai,
                'waktu_selesai' => $jadwalSetuju[$i]->waktu_selesai,
                'status' => 'Sudah Digenerate'
            ]);

            $jadwalSetuju[$i]->update([
                'status' => 'Sudah Digenerate'
            ]);
        }

        $jadwalPertemuan = JadwalPertemuan::all();
        $jumlah = $jadwalPertemuan->count();

        for($i=0;$i<$jumlah;$i++){

            if($jadwalPertemuan[$i]->hari == 'Senin'){
                $tanggal = $tanggal1;
            }else if($jadwalPertemuan[$i]->hari == 'Selasa'){
                $tanggal = $tanggal2;
            }else if($jadwalPertemuan[$i]->hari == 'Rabu'){
                $tanggal = $tanggal3;
            }else if($jadwalPertemuan[$i]->hari == 'Kamis'){
                $tanggal = $tanggal4;
            }else if($jadwalPertemuan[$i]->hari == 'Jumat'){
                $tanggal = $tanggal5;
            }

            $jadwalPertemuan[$i]->update([
                'tanggal' => $tanggal
            ]);
        }

        return redirect()->route('jadwal.indexSupervisor', compact('ids'))->with(['success' => 'Jadwal Berhasil Digenerate']);
    }
}
