<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;

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

        return redirect()->route('supervisor.index')->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        $supervisor = Supervisor::whereId($id)->first();

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
                return redirect()->route('projek.indexbyidSupervisor', compact('id'))->with(['success' => 'Password berhasil diubah']);
            }else{
                return redirect()->route('supervisor.indexPassword', compact('id'))->withErrors('Password baru dan konfirmasi berbeda')->withInput();
            }
        }else{
            return redirect()->route('supervisor.indexPassword', compact('id'))->withErrors('Password sebelumnya tidak sesuai')->withInput();
        }
    }

    public function resetPasswordSupervisor($id){
        $supervisor = Supervisor::where('id','=',$id)->first();
        $passwordBaru = $supervisor->username;
        $supervisor->update(['password' => $passwordBaru]);
        
        return redirect()->route('supervisor.index')->with(['success' => 'Password Berhasil Direset']);
    }

    public function tampilanSupervisor($id){
        return view('dashboardUser.tampilanSupervisor', compact('id'));
    }
}
