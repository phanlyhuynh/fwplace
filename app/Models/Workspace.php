<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'workspace_id');
    }
    
    public function locations()
    {
        return $this->hasMany('App\Models\location', 'workspace_id');
    }
}
