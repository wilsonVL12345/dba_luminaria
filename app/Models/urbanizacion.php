<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class urbanizacion extends Model
{

    use HasFactory;
    protected $table = "urbanizacions";
    protected $fillable = [
        'id',
        'Nrodistrito',
        'nombre_urbanizacion',
        'lng',
        'lat'
    ];
    protected $primaryKey = 'id';
}
