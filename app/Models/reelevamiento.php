<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class reelevamiento extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'reelevamientos';
    protected $fillable =
    [
        'Av_calles',
        'Fecha',
        'Descripcion',
        'Archivos',
        'Urbanizacion_id',
        'Distritos_id'

    ];
    protected $primarykey = 'id';

    public function distrito(): BelongsTo
    {
        return $this->belongsTo(distrito::class, 'Urbanizacion_id');
    }
    public function urbanizacion(): BelongsTo
    {
        return $this->belongsTo(urbanizacion::class, 'Distritos_id');
    }
}
