<?php

namespace App\Repositories;
use DB;

class WorkspaceRepository extends EloquentRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->default_color = config('site.calendar.default-color');
    }

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

    public function getData($workspace_id, $filter)
    {
        $workspace = $this->model->findOrFail($workspace_id);
        if (!$workspace || !array_key_exists('start', $filter) || !array_key_exists('end', $filter)) {
            return null;
        }
        $allShift = $this->getAllShift($workspace, $filter);

        return $allShift;
    }

    public function getAllShift($workspace, $filter)
    {
        $full_time = $this->getByShift($workspace, $filter, __('Fulltime:'), config('site.shift.all'));
        $morning = $this->getByShift($workspace, $filter, __('Morning:'), config('site.shift.morning'));
        $afternoon = $this->getByShift($workspace, $filter, __('Afternoon:'), config('site.shift.afternoon'));
        $off = $this->getByShift($workspace, $filter, __('Off:'), config('site.shift.off'), '"m-fc-event--danger"');

        return array_merge($morning, $afternoon, $full_time, $off);
    }

    public function getByShift($workspace, $filter, $title, $shift, $color = null)
    {
        $color = $color ?? $this->default_color;

        $shiftData = $workspace->work_schedules()
            ->select(DB::raw('COUNT(user_id) as total, date as start, shift, CONCAT("' . $title . '", COUNT(user_id)) as title, ' . $color . 'as className'))
            ->whereBetween('date', [$filter['start'], $filter['end']])
            ->where('shift', $shift)
            ->groupBy('date', 'shift', 'workspace_id')
            ->get()->toArray();

        return $shiftData;
    }

    public function pluckWorkspace()
    {
        return $this->model->pluck('name', 'id');
    }

    public function getOneDate($workspace_id, $date, $filter = [])
    {
        $workspace = $this->model->findOrFail($workspace_id);
        if (!$workspace || !$date) {
            return null;
        }
        $dates = ['start' => $date, 'end' => $date];
        $off = $this->getByShift($workspace, $dates, __('Off'), config('site.shift.off'));
        $data = $this->getAllShift($workspace, $dates);

        return array_merge($data, $off);
    }
}
