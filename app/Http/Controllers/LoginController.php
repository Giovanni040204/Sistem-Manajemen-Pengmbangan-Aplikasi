<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function cekLogin(Request $request)
    {
        $this->validate($request, [
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($request->role=='Supervisor'){
            return redirect()->route('projek.index')->with(['success' => 'Berhasil Login']);
        }else{
            return redirect('')->withErrors('Username dan password yang dimasukan tidak sesuai')->withInput();
        }

        // //Fungsi Simpan Data ke dalam Database
        // Projek::create([
        //     'id_user' => 0,
        //     'judul' => $request->judul,
        //     'deskripsi' => $request->deskripsi,
        //     'status' => 'Requirement Definiton',
        //     'persen' => 0
        // ]);
            
        // return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Disimpan']);
    }
}
