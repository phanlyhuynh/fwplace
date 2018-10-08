<?php

namespace App\Repositories;
use DB;

class WorkspaceRepository extends EloquentRepository
{
    public function model()
    {
        return \App\Models\Workspace::class;
    }

    public function getWorkspaces()
    {
        return $this->model->latest()->get();
    }

    public function getOwnLocation()
    {
        return $this->model->with('locations')->paginate();
    }

    public function listWorkspaceArray()
    {
        return $this->model->pluck('name', 'id')->toArray();
    }

    public function getData($workplace_id, $dates)
    {
        if (!$workspace = $this->model->find($workplace_id)) {
            return false;
        }
        $full_time = $workspace->work_schedules()
            ->select(DB::raw('date as start, shift, CONCAT("' . __('Fulltime:') . '", COUNT(user_id)) as title'))
            ->where('shift', config('site.shift.all'))
            ->groupBy('date', 'shift', 'workspace_id')
            ->get()->toArray();

        $morning = $workspace->work_schedules()
            ->select(DB::raw('date as start, shift, CONCAT("' . __('Morning:') . '", COUNT(user_id)) as title'))
            ->where('shift', config('site.shift.morning'))
            ->groupBy('date', 'shift', 'workspace_id')
            ->get()->toArray();

        $afternoon = $workspace->work_schedules()
            ->select(DB::raw('date as start, shift, CONCAT("' . __('Afternoon:') . '", COUNT(user_id)) as title'))
            ->where('shift', config('site.shift.afternoon'))
            ->groupBy('date', 'shift', 'workspace_id')
            ->get()->toArray();

        return array_merge($morning, $afternoon, $full_time);
    }
}
