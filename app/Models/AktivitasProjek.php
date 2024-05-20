<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasProjek extends Model
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
        'tanggal',
        'isi',
    ];
}
