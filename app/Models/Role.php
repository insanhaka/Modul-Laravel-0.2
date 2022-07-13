<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];

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

    public function menu()
    {
        return $this->belongsToMany(Menu::class);
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'role_id', 'id');
    }

    public function permisi()
    {
        return $this->hasMany('App\Models\Permission', 'id', 'role_id');
    }
}
