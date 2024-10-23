<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Urbanizacion extends Model
{

    use HasFactory, SoftDeletes;
    protected $table = "urbanizacions";
    protected $fillable = [
        'id',
        'Nrodistrito',
        'nombre_urbanizacion'

    ];
    protected $primaryKey = 'id';
    public function reelevamiento(): HasMany
    {
        return $this->hasMany(reelevamiento::class);
    }
}
