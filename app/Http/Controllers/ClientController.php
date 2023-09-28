<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        //get posts
        $client = Client::get();

        //render view with posts
        return view('client.index', compact('client'));
    }

    public function indexClient($id){
        $client = Client::get();
        return view('client.index', compact('client','id'));
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
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
            
        return redirect()->route('client.index')->with(['success' => 'Data Berhasil Disimpan']);
    }     

    public function edit($id){
        $client = Client::whereId($id)->first();
        
        return view('client.edit')->with('client', $client);
    } 

    public function update(Request $request, $id){
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);        
        
        $client = Client::whereId($id)->first();
        $client->update($request->all());

        return redirect()->route('client.index')->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $client = Client::whereId($id)->first();

        Client::find($id)->delete();

        return redirect()->route('client.index')->with(['success' => 'Data Berhasil Dihapus']);
    }  
}
