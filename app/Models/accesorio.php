<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class accesorio extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'accesorios';
    protected $fillable =
    [
        'Id_Lista_accesorios',
        'Cantidad',
        'Utilizados',
        'Disponibles',
        'Proyectos_id',
        'Detalles_id'
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
    public function lista_accesorio(): BelongsTo
    {
        return $this->belongsTo(lista_accesorio::class, 'Id_Lista_accesorios');
    }
}
