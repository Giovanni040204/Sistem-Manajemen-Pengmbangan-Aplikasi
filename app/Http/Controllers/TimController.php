<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use Illuminate\Http\Request;

class TimController extends Controller
{
    public function index()
    {
        //get posts
        $tim = Tim::get();

        //render view with posts
        return view('tim.index', compact('tim'));
    }

    public function create()
    {
        return view('tim.create');
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
        Tim::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
        ]);
            
        return redirect()->route('tim.index')->with(['success' => 'Data Berhasil Disimpan']);
    }     

    public function edit($id){
        $tim = Tim::whereId($id)->first();
        
        return view('tim.edit')->with('tim', $tim);
    } 

    public function update(Request $request, $id){
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);        
        
        $tim = Tim::whereId($id)->first();
        $tim->update($request->all());

        return redirect()->route('tim.index')->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $tim = Tim::whereId($id)->first();

        Tim::find($id)->delete();

        return redirect()->route('tim.index')->with(['success' => 'Data Berhasil Dihapus']);
    }  
}
