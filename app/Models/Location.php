<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = ['id'];

    public function workspace()
    {
        return $this->belongsTo('App\Models\Workspace');
    }

    public function calendars()
    {
        return $this->hasMany('App\Models\Calendar', 'location_id');
    }
}
