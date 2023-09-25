<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        //get posts
        $supervisor = Supervisor::get();

        //render view with posts
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
            'username' => 'required',
            'password' => 'required',            
        ]);

        //Fungsi Simpan Data ke dalam Database
        Supervisor::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
        ]);
            
        return redirect()->route('supervisor.index')->with(['success' => 'Data Berhasil Disimpan']);
    }     

    public function edit($id){
        $supervisor = Supervisor::whereId($id)->first();
        
        return view('supervisor.edit')->with('supervisor', $supervisor);
    } 

    public function update(Request $request, $id){
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);        
        
        $supervisor = Supervisor::whereId($id)->first();
        $supervisor->update($request->all());

        return redirect()->route('supervisor.index')->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $supervisor = Supervisor::whereId($id)->first();

        Supervisor::find($id)->delete();

        return redirect()->route('supervisor.index')->with(['success' => 'Data Berhasil Dihapus']);
    }  
}
