<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Projek;
use App\Models\Supervisor;
use App\Models\Tim;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function cekLogin(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required'=>'Username wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        if($request->username=='admin' && $request->password=='admin'){
            return redirect()->route('tampilanAdmin')->with(['success' => 'Berhasil Login']);            
        }
        $data = Supervisor::where('username','=',$request->username)->where('password','=',$request->password)->get();
        $cek = $data->count();
        
        if($cek==0){
            $data = Tim::where('username','=',$request->username)->where('password','=',$request->password)->get();
            $cek = $data->count();

            if($cek==0){
                $data = Client::where('username','=',$request->username)->where('password','=',$request->password)->get();
                $cek = $data->count();

                if($cek==0){
                    return redirect('')->with(['error' => 'Username dan Password Tidak Sesuai'])->withInput();
                }else{
                    $client = Client::where('username','=',$request->username)->where('password','=',$request->password)->first();
                    $id = $client->id;
                    return redirect()->route('tampilanClient', compact('id'))->with(['success' => 'Berhasil Login']);
                }
            }else{
                $tim = Tim::where('username','=',$request->username)->where('password','=',$request->password)->first();
                $id = $tim->id;
                return redirect()->route('tampilanTim', compact('id'))->with(['success' => 'Berhasil Login']);;
            }
        }else{
            $supervisor = Supervisor::where('username','=',$request->username)->where('password','=',$request->password)->first();
            $id = $supervisor->id;
            return redirect()->route('tampilanSupervisor', compact('id'))->with(['success' => 'Berhasil Login']);
        }
    }

    public function tampilanAdmin(){
        $sedangDikerjakan = Projek::where('persen','!=','100')->count();
        $selesai = Projek::where('status','=', 'Selesai')->count();
        $dibatalkan = Projek::where('status','=', 'Batal')->count();

        $projekBerlangsung = Projek::where('persen','!=','100')->get();

        return view('dashboardUser.tampilanAdmin', compact('sedangDikerjakan', 'selesai', 'dibatalkan', 'projekBerlangsung'));
    }
}
