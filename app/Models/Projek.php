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
        'judul',
        'deskripsi',
        'status',
        'persen',
    ];
}
