<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\Projek;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TimController extends Controller
{
    public function index()
    {
        $tim = Tim::get();

        return view('tim.index', compact('tim'));
    }

    public function indexTim(Request $request, $id){
        if($request->has('search')){
            $tim = Tim::where('nama','LIKE','%'.$request->search.'%')->get();
        }else{
            $tim = Tim::get();
        }
        
        return view('tim.index', compact('tim','id'));
    }

    public function createTim($id)
    {
        return view('tim.create', compact('id'));
    }

    public function storeTim(Request $request, $id)
    {
        //Validasi Formulir
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);

        //Fungsi Simpan Data ke dalam Database
        Tim::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
        ]);
        $tim = Tim::where('nama','=',$request->nama)->first();

        $pesan = "<p>Akun untuk Sistem Manajemen Pengembangan Aplikasi sudah dibuat dengan rincian :</p>";
        $pesan .= "<p><b>Nama : ".$tim->nama."</b></p>";
        $pesan .= "<p><b>Email : ".$tim->email."</b></p>";
        $pesan .= "<p><b>Username : ".$tim->username."</b></p>";
        $pesan .= "<p><b>Password : ".$tim->password."</b></p>";
        $pesan = "<p>Silahkan melakukan login pada sistem</p>";

        $data_email = [
            'subject' => 'Akun Dibuat',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($tim->email)->send(new kirimEmail($data_email));        
            
        return redirect()->route('tim.indexTim', compact('id'))->with(['success' => 'Data Berhasil Disimpan']);
    }     

    public function editTim($idc, $id){
        $tim = Tim::whereId($idc)->first();
        
        return view('tim.edit', compact('id'))->with('tim', $tim);
    } 

    public function updateTim(Request $request, $idc, $id){
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',          
        ]);        
        
        $tim = Tim::whereId($idc)->first();
        $tim->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username])
        ;

        $pesan = "<p>Data untuk Sistem Manajemen Pengembangan Aplikasi sudah diedit dengan rincian :</p>";
        $pesan .= "<p><b>Nama : ".$tim->nama."</b></p>";
        $pesan .= "<p><b>Email : ".$tim->email."</b></p>";
        $pesan .= "<p><b>Username : ".$tim->username."</b></p>";

        $data_email = [
            'subject' => 'Data Diedit',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($tim->email)->send(new kirimEmail($data_email));        

        return redirect()->route('tim.indexTim', compact('id'))->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroyTim($idt, $id)
    {
        $projek =  Projek::where('id_tim', $idt)->get();
        $cek = $projek->count();

        if($cek!=0){
            return redirect()->route('tim.indexTim', compact('id'))->with(['error' => 'Tim Masih Mempunyai Projek']);
        }

        Tim::find($idt)->delete();

        return redirect()->route('tim.indexTim', compact('id'))->with(['success' => 'Data Berhasil Dihapus']);
    }  

    public function indexPassword($id)
    {
        $tim = Tim::where('id','=',$id)->get();
        //render view with posts
        return view('tim.indexPassword', compact('tim', 'id'));
    }

    public function ubahPassword(Request $request, $id)
    {
        $tim = Tim::where('id','=',$id)->first();

        $request->validate([
            'lama' => 'required',
            'baru' => 'required',
            'konfirmasi' => 'required',  
        ],[
            'lama.required'=>'Tidak boleh kosong',
            'baru.required'=>'Tidak boleh kosong',
            'konfirmasi.required'=>'Tidak boleh kosong',
        ]);

        if($request->lama == $tim->password){
            if($request->baru == $request->konfirmasi){
                $tim->update(['password' => $request->baru]);

                $pesan = "<p>Password untuk Sistem Manajemen Pengembangan Aplikasi sudah DIUBAH dengan rincian :</p>";
                $pesan .= "<p><b>Nama : ".$tim->nama."</b></p>";
                $pesan .= "<p><b>Email : ".$tim->email."</b></p>";
                $pesan .= "<p><b>Username : ".$tim->username."</b></p>";
                $pesan .= "<p><b>Password : ".$tim->password."</b></p>";
        
                $data_email = [
                    'subject' => 'Ubah Password',
                    'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
                    'isi' => $pesan
                ];
                Mail::to($tim->email)->send(new kirimEmail($data_email));
                return redirect()->route('projek.indexbyidTim', compact('id'))->with(['success' => 'Password berhasil diubah']);
            }else{
                return redirect()->route('tim.indexPassword', compact('id'))->withErrors('Password baru dan konfirmasi berbeda')->withInput();
            }
        }else{
            return redirect()->route('tim.indexPassword', compact('id'))->withErrors('Password sebelumnya tidak sesuai')->withInput();
        }
    } 
    
    public function indexAdmin(Request $request){
        if($request->has('search')){
            $tim = Tim::where('nama','LIKE','%'.$request->search.'%')->get();
        }else{
            $tim = Tim::get();
        }
        return view('tim.indexAdmin', compact('tim'));
    }

    public function resetPasswordTim($id){
        $tim = Tim::where('id','=',$id)->first();
        $passwordBaru = $tim->username;
        $tim->update(['password' => $passwordBaru]);

        $pesan = "<p>Password untuk Sistem Manajemen Pengembangan Aplikasi sudah DIRESET dengan rincian :</p>";
        $pesan .= "<p><b>Nama : ".$tim->nama."</b></p>";
        $pesan .= "<p><b>Email : ".$tim->email."</b></p>";
        $pesan .= "<p><b>Username : ".$tim->username."</b></p>";
        $pesan .= "<p><b>Password : ".$tim->password."</b></p>";
        $pesan = "<p>Silahkan melakukan login pada sistem</p>";

        $data_email = [
            'subject' => 'Reset Password',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($tim->email)->send(new kirimEmail($data_email));
        return redirect()->route('tim.indexAdmin')->with(['success' => 'Password Berhasil Direset']);
    }

    public function tampilanTim($id){
        return view('dashboardUser.tampilanTim', compact('id'));
    }
}
