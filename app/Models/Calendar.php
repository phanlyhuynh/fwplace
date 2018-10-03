<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $guarded = ['id'];

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    public function workschedule()
    {
        return $this->belongsTo('App\Models\WorkSchedule');
    }
}
