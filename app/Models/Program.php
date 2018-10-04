<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	protected $fillable = ['name'];
     public function users()
    {
        return $this->hasMany('App\Models\User', 'program_id' );
    }
}
