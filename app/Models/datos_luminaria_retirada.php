<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class datos_luminaria_retirada extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'datos_luminaria_retiradas';
    protected $fillable = [

        'Nro_sisco',
        'zona',
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
        return $this->belongsTo(user::class, 'User_id');
    }
    public function distrito(): BelongsTo
    {
        return $this->belongsTo(distrito::class, 'Distritos_id');
    }
}
