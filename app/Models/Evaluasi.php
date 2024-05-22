<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;

        /**
    * fillable
    *
    * @var array
    */
    
    protected $fillable = [
        'id',
        'id_projek',
        'isi',
    ];

    public function parentProjek(){
        return $this->hasOne('App\Models\Projek','id','id_projek')->withDefault([
            'judul' => 'Tidak Ada',
        ]);
    }
}
