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

    public function indexPassword($id)
    {
        $tim = Tim::where('id','=',$id)->get();
        //render view with posts
        return view('tim.indexPassword', compact('tim', 'id'));
    }

    public function ubahPassword(Request $request, $id)
    {
        $tim = Tim::where('id','=',$id)->first();
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

        if($request->lama == $tim->password){
            if($request->baru == $request->konfirmasi){
                $tim->update(['password' => $request->baru]);
                return redirect()->route('projek.indexbyidTim', compact('id'))->with(['success' => 'Password berhasil diubah']);
            }else{
                return redirect()->route('tim.indexPassword', compact('id'))->withErrors('Password baru dan konfirmasi berbeda')->withInput();
            }
        }else{
            return redirect()->route('tim.indexPassword', compact('id'))->withErrors('Password sebelumnya tidak sesuai')->withInput();
        }
    } 
    
    public function show(){
        $tim = Tim::get();
        return view('tim.indexAdmin', compact('tim'));
    }

    public function resetPasswordTim($id){
        $tim = Tim::where('id','=',$id)->first();
        $passwordBaru = $tim->username;
        $tim->update(['password' => $passwordBaru]);
        return redirect()->route('tim.indexAdmin')->with(['success' => 'Password Berhasil Direset']);
    }
}
