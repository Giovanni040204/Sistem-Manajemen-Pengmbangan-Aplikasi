<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
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
        'topik',
        'lokasi',
        'tanggal',
        'waktu',
        'status'
    ];

    public function parentProjek(){
        return $this->hasOne('App\Models\Projek','id','id_projek')->withDefault([
            'nama' => 'Tidak Ada',
        ]);
    }
}
