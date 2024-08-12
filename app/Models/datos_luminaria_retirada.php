<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class datos_luminaria_retirada extends Model
{
    use HasFactory;
    protected $table = 'datos_luminaria_retiradas';
    protected $fillable = [
        'id',
        'zona',
        'Nro_sisco',
        'Fecha',
        'Proyecto',
        'Direccion',
        'User_id',
        'Distritos_id'
    ];
    public function lista_luminarias_reutilizadas(): HasMany
    {
        return $this->hasMany(lista_luminarias_retirada::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }
    public function distrito(): BelongsTo
    {
        return $this->belongsTo(distrito::class, 'Distritos_id');
    }
}
