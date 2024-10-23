<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'detalles';
    protected $fillable =
    [
        'id',
        'Nro_Sisco',
        'Zona',
        'Tipo_Trabajo',
        'Foto_Carta',
        'Puntos',
        'Fecha_Programado',
        'Fecha_Inicio',
        'Estado',
        'Observaciones',
        'Detalles',
        'EjecutadoPor',
        'Users_id',
        'Distritos_id'
    ];
    protected $primarykey = 'id';
    public function accesorios(): HasMany
    {
        return $this->hasMany(accesorio::class);
    }
    public function luminarias(): HasMany
    {
        return $this->hasMany(luminaria::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'Users_id');
    }
    public function distrito(): BelongsTo
    {
        return $this->belongsTo(distrito::class, 'Distritos_id');
    }
}
