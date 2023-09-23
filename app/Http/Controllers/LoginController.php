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
            'role'=>'required',
            'username'=>'required',
            'password'=>'required'
        ],[
            'role.required'=>'Role wajib diisi',
            'username.required'=>'Username wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);



        if($request->role=='Supervisor'){
            $data = Supervisor::where('username','=',$request->username)->where('password','=',$request->password)->get();
            $cek = $data->count();

            if($cek==0){
                return redirect('')->withErrors('Username dan password yang dimasukan tidak sesuai')->withInput();
            }else{
                $supervisor = Supervisor::where('username','=',$request->username)->where('password','=',$request->password)->first();
                $projek = Projek::where('id_supervisor','=',$supervisor->id)->get();
                return view('projek.index', compact('projek'))->with(['success' => 'Berhasil Login']);;
                // return redirect()->route('projek.index',$supervisor->id)->with(['success' => 'Berhasil Login']);
            }
        }else if($request->role=='Tim'){
            $data = Tim::where('username','=',$request->username)->where('password','=',$request->password)->get();
            $cek = $data->count();

            if($cek==0){
                return redirect('')->withErrors('Username dan password yang dimasukan tidak sesuai')->withInput();
            }else{
                $tim = Tim::where('username','=',$request->username)->where('password','=',$request->password)->first();
                $projek = Projek::where('id_tim','=',$tim->id)->get();
                return view('projek.index', compact('projek'))->with(['success' => 'Berhasil Login']);;
            }
        }else if($request->role=='Client'){
            $data = Client::where('username','=',$request->username)->where('password','=',$request->password)->get();
            $cek = $data->count();

            if($cek==0){
                return redirect('')->withErrors('Username dan password yang dimasukan tidak sesuai')->withInput();
            }else{
                $client = Client::where('username','=',$request->username)->where('password','=',$request->password)->first();
                $projek = Projek::where('id_client','=',$client->id)->get();
                return view('projek.index', compact('projek'))->with(['success' => 'Berhasil Login']);;
            }
        }else{
            return redirect('')->withErrors('Username dan password yang dimasukan tidak sesuai')->withInput();
        }
    }
}
