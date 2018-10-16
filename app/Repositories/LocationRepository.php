<?php

namespace App\Repositories;

use DB;
use Carbon\CarbonPeriod;

class LocationRepository extends EloquentRepository
{
    public function model()
    {
        return \App\Models\Location::class;
    }

    public function listLocation($filter)
    {
        if (is_array($filter)) {
            $model = $this->model->with('workspace');
            if ($filter['workspace_id']) {
                $model->where('workspace_id', $filter['workspace_id']);
            }
            if ($filter['name']) {
                $model->where('name', 'like', '%' . $filter['name'] . '%');
            }
            
            return $model->latest()->paginate(config('database.paginate'));
        }

        return $this->model
                ->with('workspace')
                ->latest()
                ->paginate(config('database.paginate'));
    }

    public function getByWorkspace($workspace_id)
    {
        return $this->model->where('workspace_id', $workspace_id)->pluck('name', 'id')->prepend(__('--Chose Location--'), config('site.default_location'))->toArray();
    }

    public function getData($location_id, $filter)
    {
        $location = $this->model->findOrFail($location_id);
        if (!array_key_exists('start', $filter) || !array_key_exists('end', $filter)) {
            return null;
        }
        $all_shift = $this->getAllShift($location, $filter);

        return $all_shift;
    }

    public function getAllShift($location, $filter)
    {
        $full_time_seat = $this->getByShift($location, $filter, config('site.shift.all'))->pluck('total', 'start')->toArray();
        $morning = $this->getByShift($location, $filter, config('site.shift.morning'))->pluck('total', 'start')->toArray();
        $afternoon = $this->getByShift($location, $filter, config('site.shift.afternoon'))->pluck('total', 'start')->toArray();
        $total = $this->getTotalSeatData($filter, __('Total Seat'), config('site.analystic.total-color'), $location->total_seat);

        $morning_data = $this->analystic($full_time_seat, $morning, $filter, __('1. Morning:'), config('site.analystic.default-color'));
        $afternoon_data = $this->analystic($full_time_seat, $afternoon, $filter, __('2. Afternoon:'), config('site.analystic.afternoon-color'));

        return array_merge($morning_data, $afternoon_data, $total);
    }

    public function getTotalSeatData($filter, $title, $className, $total_seat)
    {
        $dates = $this->getDatesOfFilter($filter);
        $data = [];
        foreach ($dates as $date) {
            $data[] = [
                'start' => $date,
                'title' => $title . ': ' . $total_seat,
                'className' => $className
            ];
        }

        return $data;
    }

    public function getDatesOfFilter($filter)
    {
        if (!is_array($filter) || !array_key_exists('start', $filter) || !array_key_exists('end', $filter)) {
            return null;
        }
        $dates = CarbonPeriod::create($filter['start'], $filter['end'])->toArray();
        $array_dates = [];
        foreach ($dates as $date) {
            if (!$date->isWeekend()) {
                $array_dates[] = $date->format('Y-m-d');
            }
        }

        return $array_dates;
    }

    public function analystic($full_time_seat, $shiftData, $filter, $title, $className)
    {
        if (!is_array($full_time_seat) && !$shiftData) {
            return;
        }
        $dates = $this->getDatesOfFilter($filter);
        $data = [];
        foreach ($dates as $date) {
            if (array_key_exists($date, $shiftData)) {
                $count = $shiftData[$date];
            } else {
                $count = 0;
            }
            if (array_key_exists($date, $full_time_seat)) {
                $count += $full_time_seat[$date];
            }
            $data[] = [
                'start' => $date,
                'title' => $title . ' ' . $count,
                'className' => $className
            ];
        }

        return $data;
    }

    public function getByShift($location, $filter, $shift)
    {
        $shiftData = $location->work_schedules()
            ->select(DB::raw('COUNT(user_id) as total, date as start, shift'))
            ->whereBetween('date', [$filter['start'], $filter['end']])
            ->where('shift', $shift);
            
        if (array_key_exists('program_id', $filter) && $filter['program_id']) {
            $get_user_by_program = DB::table('users')->where('program_id', $filter['program_id'])->pluck('id');
            $shiftData = $shiftData->whereIn('user_id', $get_user_by_program);
        }
        $shiftData = $shiftData->groupBy('date', 'shift')->get();

        return $shiftData;
    }
}
