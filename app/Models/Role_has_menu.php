<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_has_menu extends Model
{
    use HasFactory;
    protected $table = 'menu_role';
    protected $fillable = [
        'role_id',
        'menu_id'
    ];
}
