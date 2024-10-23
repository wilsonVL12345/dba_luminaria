<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\roles;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable =
    [
        'name',
    ];
    protected $primarykey = 'id';
}
