<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{

    public function indexClient(Request $request, $id){
        if($request->has('search')){
            $client = Client::where('nama','LIKE','%'.$request->search.'%')->get();
        }else{
            $client = Client::get();
        }
        
        return view('client.index', compact('client','id'))->with('id', $id);;
    }

    public function createClient($id)
    {
        return view('client.create', compact('id'));
    }
    
    public function storeClient(Request $request, $id)
    {
        //Validasi Formulir
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);

        //Fungsi Simpan Data ke dalam Database
        Client::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        $client = Client::where('nama','=',$request->nama)->get();

        $pesan = "<p>Akun untuk Sistem Manajemen Pengembangan Aplikasi sudah dibuat dengan rincian :</p>";
        $pesan .= "<p><b>Nama : ".$client->nama."</b></p>";
        $pesan .= "<p><b>Email : ".$client->email."</b></p>";
        $pesan .= "<p><b>Username : ".$client->username."</b></p>";
        $pesan .= "<p><b>Password : ".$client->password."</b></p>";
        $pesan = "<p>Silahkan melakukan login pada sistem</p>";

        $data_email = [
            'subject' => 'Akun Dibuat',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($client->email)->send(new kirimEmail($data_email));
            
        return redirect()->route('client.indexClient', compact('id'))->with(['success' => 'Data Berhasil Disimpan']);
    }
    
    public function editClient($idc, $id){
        $client = Client::whereId($idc)->first();
        
        return view('client.edit', compact('id'))->with('client', $client);
    }

    public function updateClient(Request $request, $idc, $id){
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'username' => 'required',           
        ]);        
        
        $client = Client::whereId($idc)->first();
        $client->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username])
        ;

        $pesan = "<p>Data untuk Sistem Manajemen Pengembangan Aplikasi sudah diedit dengan rincian :</p>";
        $pesan .= "<p><b>Nama : ".$client->nama."</b></p>";
        $pesan .= "<p><b>Email : ".$client->email."</b></p>";
        $pesan .= "<p><b>Username : ".$client->username."</b></p>";

        $data_email = [
            'subject' => 'Data Diedit',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($client->email)->send(new kirimEmail($data_email));

        return redirect()->route('client.indexClient', compact('id'))->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $client = Client::whereId($id)->first();

        Client::find($id)->delete();

        return redirect()->route('client.index')->with(['success' => 'Data Berhasil Dihapus']);
    }  

    public function destroyClient($idc, $id)
    {
        $client = Client::whereId($idc)->first();

        Client::find($idc)->delete();

        return redirect()->route('client.indexClient', compact('id'))->with(['success' => 'Data Berhasil Dihapus']);
    }
    
    public function indexPassword($id)
    {
        $client = Client::where('id','=',$id)->get();
        //render view with posts
        return view('client.indexPassword', compact('client', 'id'));
    }

    public function ubahPassword(Request $request, $id)
    {
        $client = Client::where('id','=',$id)->first();

        $request->validate([
            'lama' => 'required',
            'baru' => 'required',
            'konfirmasi' => 'required',  
        ],[
            // 'role.required'=>'Role wajib diisi',
            'lama.required'=>'Tidak boleh kosong',
            'baru.required'=>'Tidak boleh kosong',
            'konfirmasi.required'=>'Tidak boleh kosong',
        ]);

        if($request->lama == $client->password){
            if($request->baru == $request->konfirmasi){
                $client->update(['password' => $request->baru]);

                $pesan = "<p>Password untuk Sistem Manajemen Pengembangan Aplikasi sudah DIUBAH dengan rincian :</p>";
                $pesan .= "<p><b>Nama : ".$client->nama."</b></p>";
                $pesan .= "<p><b>Email : ".$client->email."</b></p>";
                $pesan .= "<p><b>Username : ".$client->username."</b></p>";
                $pesan .= "<p><b>Password : ".$client->password."</b></p>";
        
                $data_email = [
                    'subject' => 'Ubah Password',
                    'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
                    'isi' => $pesan
                ];
                Mail::to($client->email)->send(new kirimEmail($data_email));

                return redirect()->route('projek.indexbyidClient', compact('id'))->with(['success' => 'Password berhasil diubah']);
            }else{
                return redirect()->route('client.indexPassword', compact('id'))->withErrors('Password baru dan konfirmasi berbeda')->withInput();
            }
        }else{
            return redirect()->route('client.indexPassword', compact('id'))->withErrors('Password sebelumnya tidak sesuai')->withInput();
        }
    }

    public function indexAdmin(Request $request){
        if($request->has('search')){
            $client = Client::where('nama','LIKE','%'.$request->search.'%')->get();
        }else{
            $client = Client::get();
        }
        
        return view('client.indexAdmin', compact('client'));
    }

    public function resetPasswordClient($id){
        $client = Client::where('id','=',$id)->first();
        $passwordBaru = $client->username;
        $client->update(['password' => $passwordBaru]);

        $pesan = "<p>Password untuk Sistem Manajemen Pengembangan Aplikasi sudah DIRESET dengan rincian :</p>";
        $pesan .= "<p><b>Nama : ".$client->nama."</b></p>";
        $pesan .= "<p><b>Email : ".$client->email."</b></p>";
        $pesan .= "<p><b>Username : ".$client->username."</b></p>";
        $pesan .= "<p><b>Password : ".$client->password."</b></p>";
        $pesan = "<p>Silahkan melakukan login pada sistem</p>";

        $data_email = [
            'subject' => 'Reset Password',
            'sender_name' => 'sistemmanajemenpengembanganapl@gmail.com',
            'isi' => $pesan
        ];
        Mail::to($client->email)->send(new kirimEmail($data_email));

        return redirect()->route('client.indexAdmin')->with(['success' => 'Password Berhasil Direset']);
    }

    public function tampilanClient($id){
        return view('dashboardUser.tampilanClient', compact('id'));
    }
}
