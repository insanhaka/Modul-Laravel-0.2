<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $guarded = [];

    // public static function boot()
    // {
    //     parent::boot();
    //     static::saving(function ($model) {
    //         $model->created_by = \Auth::user()->name;
    //     });
    //     static::updating(function ($model) {
    //         $model->updated_by = \Auth::user()->name;
    //     });
    // }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'user_id', 'role_id');
    }

    public function menu()
    {
        return $this->belongsToMany(Menu::class);
    }

    // public function permission()
    // {
    //     return $this->hasMany(Permission::class);
    // }

    public function permisi()
    {
        return $this->hasMany('App\Models\Permission', 'id', 'role_id');
    }
}
