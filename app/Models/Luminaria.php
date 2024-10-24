<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Luminaria extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'luminarias';
    protected $fillable =
    [
        'Modelo',
        'Marca',
        'Potencia',
        'Cod_Luminaria',
        'Lugar_Instalado',
        'latitud',
        'longitud',
        'Proyectos_id',
        'Detalles_id',

    ];
    protected $primarykey = 'id';

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(proyecto::class);
    }
    public function detalle(): BelongsTo
    {
        return $this->belongsTo(detalle::class);
    }
}
