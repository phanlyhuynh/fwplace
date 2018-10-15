<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'total_seat',
        'image',
        'workspace_id'
    ];

    public function workspace()
    {
        return $this->belongsTo('App\Models\Workspace');
    }

    public function calendars()
    {
        return $this->hasMany('App\Models\Calendar', 'location_id');
    }
    public function work_schedules()
    {
        return $this->hasMany('App\Models\WorkSchedule', 'location_id');
    }

    public function getPhotoAttribute()
    {
        if ($this->image) {
            return asset(config('site.location.display-image') . $this->image);
        }

        return asset(config('site.default-image'));
    }
}
