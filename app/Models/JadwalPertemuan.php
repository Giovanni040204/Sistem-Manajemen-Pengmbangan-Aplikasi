<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPertemuan extends Model
{
    use HasFactory;

        /**
    * fillable
    *
    * @var array
    */
    
    protected $fillable = [
        'id',
        'id_supervisor',
        'id_tim',
        'id_projek',
        'hari',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'status'
    ];

    public function parentProjek(){
        return $this->hasOne('App\Models\Projek','id','id_projek')->withDefault([
            'nama' => 'Tidak Ada',
        ]);
    }

}
