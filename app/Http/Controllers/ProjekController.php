<?php

namespace App\Http\Controllers;

use App\Models\Projek;
use Illuminate\Http\Request;

class ProjekController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get posts
        $projek = Projek::get();
        //render view with posts
        return view('projek.index', compact('projek'));
    }

    public function create()
    {
        return view('projek.create');
    }

    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        //Fungsi Simpan Data ke dalam Database
        Projek::create([
            'id_user' => 0,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'Requirement Definiton',
            'persen' => 0
        ]);
            
        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Disimpan']);
    }    

    public function edit($id){
        $projek = Projek::whereId($id)->first();
        $status = ['Requirement Definiton','Design','Development','Intergration and Testing','Intallation and Acceptance'];
        
        return view('projek.edit', compact('status'))->with('projek', $projek);
    } 

    public function update(Request $request, $id){
        $projek = Projek::whereId($id)->first();
        $projek->update($request->all());

        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy($id)
    {
        Projek::find($id)->delete();
        return redirect(route('projek.index'))->with(['success' => 'Data Berhasil Dihapus']);
    }    
}
