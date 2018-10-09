<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{

    protected $fillable = [
        'name', 
        'image'
    ];

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany('App\User', 'workspace_id');
    }
    
    public function locations()
    {
        return $this->hasMany('App\Models\Location', 'workspace_id');
    }

    public function getPhotoAttribute()
    {
        return asset(config('site.workspace.display-image') . $this->image);
    }

    public function work_schedules()
    {
        return $this->hasManyThrough('App\Models\WorkSchedule', 'App\User');
    }

    public function delete()
    {
        if ($this->users()->count() > 0) {
            return false;
        }
        $this->locations()->delete();

        return parent::delete();
    }

    public function getTotalSeatAttribute()
    {
        $total = $this->locations()->sum('total_seat');
        
        return $total;
    }
}
