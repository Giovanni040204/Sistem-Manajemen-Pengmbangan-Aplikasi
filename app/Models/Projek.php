<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    use HasFactory;

    /**
    * fillable
    *
    * @var array
    */
    
    protected $fillable = [
        'id_supervisor',
        'id_tim',
        'id_client',
        'judul',
        'deskripsi',
        'status',
        'persen',
    ];

    public function parentSupervisor(){
        return $this->hasOne('App\Models\Supervisor','id','id_supervisor')->withDefault([
            'nama' => 'Tidak Ada',
        ]);
    }

    public function parentTim(){
        return $this->hasOne('App\Models\Tim','id','id_tim')->withDefault([
            'nama' => 'Tidak Ada',
        ]);
    }

    public function parentClient(){
        return $this->hasOne('App\Models\Client','id','id_client')->withDefault([
            'nama' => 'Tidak Ada',
        ]);;
    }
}
