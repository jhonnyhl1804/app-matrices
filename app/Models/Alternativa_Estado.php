<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternativa_Estado extends Model
{
    use HasFactory;

    protected $table = "alternativa_estado";

    protected $fillable = [

        'id',
        'id_estado',
        'id_alternativa',
        'id_problema',
        'valor'

    ];
    public $timestamps = false;
}
