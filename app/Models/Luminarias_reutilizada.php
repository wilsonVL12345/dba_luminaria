<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Luminarias_reutilizada extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'luminarias_reutilizadas';
    protected $fillable =
    [

        'Nombre_Item',
        'Cantidad',
        'Disponibles',
        'Utilizados',
        'Observaciones',
        'Proyectos_id'

    ];
    protected $primarykey = 'id';
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(proyecto::class, 'Proyectos_id');
    }
}
