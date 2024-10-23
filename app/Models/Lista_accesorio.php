<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lista_accesorio extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'lista_accesorios';
    protected $fillable =
    [
        'id',
        'Nombre_Item'
    ];
    protected $primaryKey = 'id';

    public function accesorios(): HasMany
    {
        return $this->hasMany(accesorio::class);
    }
}
