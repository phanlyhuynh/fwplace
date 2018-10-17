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
        $totalSeat = $location->total_seat;
        $fullTimeSeat = $this->getByShift($location, $filter, config('site.shift.all'))
            ->pluck('total', 'start')
            ->toArray();
        $morning = $this->getByShift($location, $filter, config('site.shift.morning'))
            ->pluck('total', 'start')
            ->toArray();
        $afternoon = $this->getByShift($location, $filter, config('site.shift.afternoon'))
            ->pluck('total', 'start')
            ->toArray();

        $morningData = $this->analystic(
            $fullTimeSeat,
            $morning,
            $filter,
            __('1. Morning:'),
            config('site.analystic.default-color'),
            $totalSeat
        );
        $afternoonData = $this->analystic(
            $fullTimeSeat,
            $afternoon,
            $filter,
            __('2. Afternoon:'),
            config('site.analystic.afternoon-color'),
            $totalSeat
        );

        return array_merge($morningData, $afternoonData);
    }

    public function getDatesOfFilter($filter)
    {
        if (!is_array($filter) || !array_key_exists('start', $filter) || !array_key_exists('end', $filter)) {
            return null;
        }
        $dates = CarbonPeriod::create($filter['start'], $filter['end'])->toArray();
        $arrayDates = [];
        foreach ($dates as $date) {
            if (!$date->isWeekend()) {
                $arrayDates[] = $date->format('Y-m-d');
            }
        }

        return $arrayDates;
    }

    public function analystic($fullTimeSeat, $shiftData, $filter, $title, $className, $totalSeat)
    {
        if (!is_array($fullTimeSeat) && !$shiftData) {
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
            if (array_key_exists($date, $fullTimeSeat)) {
                $count += $fullTimeSeat[$date];
            }
            $count = $totalSeat - $count;
            if ($count < 0) {
                $count = __('lacking') . $count * -1;
            } elseif ($count >= 0) {
                $count = __('over') . $count;
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
