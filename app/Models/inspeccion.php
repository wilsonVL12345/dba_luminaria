<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class inspeccion extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'inspecciones';
    protected $fillable =
    [
        'id',
        'Nro_Sisco',
        'ZonaUrbanizacion',
        'Tipo_Inspeccion',
        'Estado',
        'Fecha_Inspeccion',
        'Foto_Carta',
        'Inspeccion',
        'Detalles',
        'Inspector',
        'users_id',
        'Distritos_id',
    ];
    protected $primarykey = 'id';
    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class, 'users_id');
    }
    public function distrito(): BelongsTo
    {
        return $this->belongsTo(distrito::class, 'Distritos_id');
    }
}
