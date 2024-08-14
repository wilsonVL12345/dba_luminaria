<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class lista_luminarias_retirada extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'lista_luminarias_retiradas';
    protected $fillable = [
        'Nombre',
        'Cantidad',
        'Reutilizables',
        'NoReutilizables',
        'Observaciones',
        'datos_luminaria_id'
    ];
    protected $primarykey = 'id';

    public function datos_luminaria_retirada(): BelongsTo
    {
        return $this->belongsTo(datos_luminaria_retirada::class, 'lista_luminaria_id');
    }
}
