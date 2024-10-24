<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Illuminate\Database\Eloquent\SoftDeletes;

class Equipamiento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'equipamientos';
    protected $fillables =
    [
        'id',
        'Nombre_Item',
        'Descripcion',
        'estado',
        'Distritos_id'
    ];
    protected $primarykey = 'id';
    public function distrito(): BelongsTo
    {
        return $this->belongsTo(distrito::class, 'Distritos_id');
    }
}
