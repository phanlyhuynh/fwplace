<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['name', 'is_fulltime'];

     public function users()
    {
        return $this->hasMany('App\Models\User', 'position_id');
    }
}
