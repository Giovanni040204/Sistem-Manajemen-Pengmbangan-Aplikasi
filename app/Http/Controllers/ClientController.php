<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // public function index()
    // {
    //     //get posts
    //     $client = Client::get();

    //     //render view with posts
    //     return view('client.index', compact('client'));
    // }

    public function indexClient($id){
        $client = Client::get();
        return view('client.index', compact('client','id'))->with('id', $id);;
    }

    // public function create()
    // {
    //     return view('client.create');
    // }

    public function createClient($id)
    {
        return view('client.create', compact('id'));
    }

    // public function store(Request $request)
    // {
    //     //Validasi Formulir
    //     $this->validate($request, [
    //         'nama' => 'required',
    //         'username' => 'required',
    //         'password' => 'required',            
    //     ]);

    //     //Fungsi Simpan Data ke dalam Database
    //     Client::create([
    //         'nama' => $request->nama,
    //         'username' => $request->username,
    //         'password' => $request->password,
    //     ]);
            
    //     return redirect()->route('client.indexClient')->with(['success' => 'Data Berhasil Disimpan']);
    // }
    
    public function storeClient(Request $request, $id)
    {
        //Validasi Formulir
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);

        //Fungsi Simpan Data ke dalam Database
        Client::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
        ]);
            
        return redirect()->route('client.indexClient', compact('id'))->with(['success' => 'Data Berhasil Disimpan']);
    } 

    // public function edit($id){
    //     $client = Client::whereId($id)->first();
        
    //     return view('client.edit')->with('client', $client);
    // }
    
    public function editClient($idc, $id){
        $client = Client::whereId($idc)->first();
        
        return view('client.edit', compact('id'))->with('client', $client);
    } 

    // public function update(Request $request, $id){
    //     $this->validate($request, [
    //         'nama' => 'required',
    //         'username' => 'required',
    //         'password' => 'required',            
    //     ]);        
        
    //     $client = Client::whereId($id)->first();
    //     $client->update($request->all());

    //     return redirect()->route('client.index')->with(['success' => 'Data Berhasil Diedit']);
    // }

    public function updateClient(Request $request, $idc, $id){
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);        
        
        $client = Client::whereId($idc)->first();
        $client->update($request->all());

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
        // //render view with posts
        // $this->validate($request, [
        //     'lama' => 'required',
        //     'baru' => 'required',
        //     'konfirmasi' => 'required',            
        // ]);

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
                return redirect()->route('projek.indexbyidClient', compact('id'))->with(['success' => 'Password berhasil diubah']);
            }else{
                return redirect()->route('client.indexPassword', compact('id'))->withErrors('Password baru dan konfirmasi berbeda')->withInput();
            }
        }else{
            return redirect()->route('client.indexPassword', compact('id'))->withErrors('Password sebelumnya tidak sesuai')->withInput();
        }
    }

    public function show(){
        $client = Client::get();
        return view('client.indexAdmin', compact('client'));
    }

    public function resetPasswordClient($id){
        $client = Client::where('id','=',$id)->first();
        $passwordBaru = $client->username;
        $client->update(['password' => $passwordBaru]);
        return redirect()->route('client.indexAdmin')->with(['success' => 'Password Berhasil Direset']);
    }
}
