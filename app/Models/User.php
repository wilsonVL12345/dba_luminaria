<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'Paterno',
        'Materno',
        'Ci',
        'Expedido',
        'Celular',
        'Genero',
        'Cargo',
        'Lugar_Designado',
        'Estado',
        'perfil',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function proyectos(): HasMany
    {
        return $this->hasMany(proyecto::class);
    }
    public function detalles(): HasMany
    {
        return $this->hasMany(detalle::class);
    }
    public function inspecciones(): HasMany
    {
        return $this->hasMany(inspeccion::class);
    }
    public function datos_luminaria_retiradas(): HasMany
    {
        return $this->hasMany(datos_luminaria_retirada::class);
    }
}
