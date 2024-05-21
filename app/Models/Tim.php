<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    use HasFactory;

    /**
    * fillable
    *
    * @var array
    */
    
    protected $fillable = [
        'id',
        'nama',
        'email',
        'username',
        'password',
    ]; 
}
