<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class lista_accesorio extends Model
{
    use HasFactory;
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
