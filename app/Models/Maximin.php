<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maximin extends Model
{
    use HasFactory;

    protected $table = "maximin";

    protected $fillable = [

        'id',
        'id_alternativa_estado',
        'Seleccionada',
        'Observacion'

    ];
    public $timestamps = false;

}
