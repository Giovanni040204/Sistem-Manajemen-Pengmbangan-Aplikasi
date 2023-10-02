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

    public function indexTim($id){
        $tim = Tim::get();
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
            'username' => 'required',
            'password' => 'required',            
        ]);

        //Fungsi Simpan Data ke dalam Database
        Tim::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
        ]);
            
        return redirect()->route('tim.indexTim', compact('id'))->with(['success' => 'Data Berhasil Disimpan']);
    }     

    public function editTim($idc, $id){
        $tim = Tim::whereId($idc)->first();
        
        return view('tim.edit', compact('id'))->with('tim', $tim);
    } 

    public function updateTim(Request $request, $idc, $id){
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',            
        ]);        
        
        $tim = Tim::whereId($idc)->first();
        $tim->update($request->all());

        return redirect()->route('tim.indexTim', compact('id'))->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroyTim($idc, $id)
    {
        $tim = Tim::whereId($idc)->first();

        Tim::find($idc)->delete();

        return redirect()->route('tim.indexTim', compact('id'))->with(['success' => 'Data Berhasil Dihapus']);
    }  
}
