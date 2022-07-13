<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->created_by = \Auth::user()->name;
        });
        static::updating(function ($model) {
            $model->updated_by = \Auth::user()->name;
        });
    }

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
