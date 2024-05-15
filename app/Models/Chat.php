<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

        /**
    * fillable
    *
    * @var array
    */
    
    protected $fillable = [
        'id',
        'id_client',
        'id_tim',
        'id_projek',
        'isi',
        'tanggal',
        'waktu',
        'status'
    ];

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
