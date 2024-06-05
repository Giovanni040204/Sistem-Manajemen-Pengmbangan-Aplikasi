<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\Projek;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupervisorController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $supervisor= Supervisor::where('nama','LIKE','%'.$request->search.'%')->get();
        }else{
            $supervisor = Supervisor::get();
        }

        return view('supervisor.index', compact('supervisor'));
    }

    public function create()
    {
        return view('supervisor.create');
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);

        Supervisor::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
        ]);
        $supervisor = Supervisor::where('nama','=',$request->nama)->first();

        $pesan = "<p>Akun untuk Sistem Manajemen Pengembangan Aplikasi sudah dibuat dengan rincian :</p>";
        $pesan .= "<p><b>Nama : ".$supervisor->nama."</b></p>";
        $pesan .= "<p><b>Email : ".$supervisor->email."</b></p>";
        $pesan .= "<p><b>Username : ".$supervisor->username."</b></p>";
        $pesan .= "<p><b>Password : ".$supervisor->password."</b></p>";
        $pesan = "<p>Silahkan melakukan login pada sistem</p>";

        $data_email = [
            'subject' => 'Akun Dibuat',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($supervisor->email)->send(new kirimEmail($data_email));  
            
        return redirect()->route('supervisor.index')->with(['success' => 'Data Berhasil Disimpan']);
    }     

    public function edit($id){
        $supervisor = Supervisor::whereId($id)->first();
        
        return view('supervisor.edit')->with('supervisor', $supervisor);
    } 

    public function update(Request $request, $id){
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',           
        ]);        
        
        $supervisor = Supervisor::whereId($id)->first();
        $supervisor->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username])
        ;

        $pesan = "<p>Data untuk Sistem Manajemen Pengembangan Aplikasi sudah diedit dengan rincian :</p>";
        $pesan .= "<p><b>Nama : ".$supervisor->nama."</b></p>";
        $pesan .= "<p><b>Email : ".$supervisor->email."</b></p>";
        $pesan .= "<p><b>Username : ".$supervisor->username."</b></p>";

        $data_email = [
            'subject' => 'Data Diedit',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($supervisor->email)->send(new kirimEmail($data_email));   

        return redirect()->route('supervisor.index')->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $projek =  Projek::where('id_supervisor', $id)->get();
        $cek = $projek->count();

        if($cek!=0){
            return redirect()->route('supervisor.index')->with(['error' => 'Supervisor Masih Mempunyai Projek']);
        }

        Supervisor::find($id)->delete();

        return redirect()->route('supervisor.index')->with(['success' => 'Data Berhasil Dihapus']);
    } 
    
    public function indexPassword($id)
    {
        $supervisor = Supervisor::where('id','=',$id)->get();

        return view('supervisor.indexPassword', compact('supervisor', 'id'));
    }

    public function ubahPassword(Request $request, $id)
    {
        $supervisor = Supervisor::where('id','=',$id)->first();

        $request->validate([
            'lama' => 'required',
            'baru' => 'required',
            'konfirmasi' => 'required',  
        ],[
            'lama.required'=>'Tidak boleh kosong',
            'baru.required'=>'Tidak boleh kosong',
            'konfirmasi.required'=>'Tidak boleh kosong',
        ]);

        if($request->lama == $supervisor->password){
            if($request->baru == $request->konfirmasi){
                $supervisor->update(['password' => $request->baru]);

                $pesan = "<p>Password untuk Sistem Manajemen Pengembangan Aplikasi sudah DIUBAH dengan rincian :</p>";
                $pesan .= "<p><b>Nama : ".$supervisor->nama."</b></p>";
                $pesan .= "<p><b>Email : ".$supervisor->email."</b></p>";
                $pesan .= "<p><b>Username : ".$supervisor->username."</b></p>";
                $pesan .= "<p><b>Password : ".$supervisor->password."</b></p>";
        
                $data_email = [
                    'subject' => 'Ubah Password',
                    'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
                    'isi' => $pesan
                ];
                Mail::to($supervisor->email)->send(new kirimEmail($data_email));

                return redirect()->route('projek.indexbyidSupervisor', compact('id'))->with(['success' => 'Password berhasil diubah']);
            }else{
                return redirect()->route('supervisor.indexPassword', compact('id'))->withErrors('Password baru dan konfirmasi berbeda')
                ->withInput();
            }
        }else{
            return redirect()->route('supervisor.indexPassword', compact('id'))->withErrors('Password sebelumnya tidak sesuai')->withInput();
        }
    }

    public function resetPasswordSupervisor($id){
        $supervisor = Supervisor::where('id','=',$id)->first();
        $passwordBaru = $supervisor->username;
        $supervisor->update(['password' => $passwordBaru]);
        
        $pesan = "<p>Password untuk Sistem Manajemen Pengembangan Aplikasi sudah DIRESET dengan rincian :</p>";
        $pesan .= "<p><b>Nama : ".$supervisor->nama."</b></p>";
        $pesan .= "<p><b>Email : ".$supervisor->email."</b></p>";
        $pesan .= "<p><b>Username : ".$supervisor->username."</b></p>";
        $pesan .= "<p><b>Password : ".$supervisor->password."</b></p>";
        $pesan = "<p>Silahkan melakukan login pada sistem</p>";

        $data_email = [
            'subject' => 'Reset Password',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($supervisor->email)->send(new kirimEmail($data_email));
        return redirect()->route('supervisor.index')->with(['success' => 'Password Berhasil Direset']);
    }

    public function tampilanSupervisor($id){
        $sedangDikerjakan = Projek::where('persen','!=','100')->count();
        $selesai = Projek::where('status','=', 'Selesai')->count();
        $dibatalkan = Projek::where('status','=', 'Batal')->count();

        $projekBerlangsung = Projek::where('persen','!=','100')->get();

        return view('dashboardUser.tampilanSupervisor', compact('sedangDikerjakan', 'selesai', 'dibatalkan', 'projekBerlangsung','id'));
    }
}
