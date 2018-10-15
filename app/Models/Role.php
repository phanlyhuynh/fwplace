<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $guarded = ['id'];
    protected $table = 'roles';

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
}
