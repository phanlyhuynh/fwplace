<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends EloquentRepository
{

    public function model()
    {
        return User::class;
    }

    public function getListName($name)
    {
        return $this->model->where('name', 'like','%' . $name . '%');
    }

    public function getList($field, $field_id)
    {
        return $this->model->where($field, '=', $field_id);
    }

    public function getDataUserTimesheet($user_id, $dates)
    {
        $user = $this->model->findOrFail($user_id);
        $fulltime = $this->getByShift($user, $dates, '-' . __('Fulltime'), config('site.shift.all'), config('site.calendar.fulltime-color'));
        $morning = $this->getByShift($user, $dates, '-' . __('Morning'), config('site.shift.morning'));
        $afternoon = $this->getByShift($user, $dates, '-' . __('Afternoon'), config('site.shift.afternoon'), config('site.calendar.afternoon-color'));
        $off = $this->getByShift($user, $dates, '-' . __('Off'), config('site.shift.off'), config('site.calendar.off-color'));
        $locations = $this->getLocationByDay($user, $dates);

        return array_merge($fulltime, $morning, $afternoon, $off, $locations);
    }

    public function getByShift($user, $dates, $trans, $shift, $color = null)
    {
        $color = $color ?? config('site.calendar.default-color');

        return $user->work_schedules()
            ->select(DB::raw('date as start, "' . $trans . '" as title, ' . $color . 'as className'))
            ->whereBetween('date', [$dates['start'], $dates['end']])
            ->where('shift', $shift)
            ->get()->toArray();
    }

    public function getLocationByDay($user, $dates, $color = null)
    {
        $color = $color ?? config('site.calendar.default-color');

        $data = $user->work_schedules()
            ->select(DB::raw('date as start, location_id, shift'))
            ->whereBetween('date', [$dates['start'], $dates['end']])
            ->get();

        if ($data->count() <= 0) {
            return;
        }
        $locationByDay = [];
        foreach ($data as $item) {
            $location = DB::table('locations')->find($item->location_id);
            if ($item->shift != 0 && $item->location_id != 0 && $location) {
                $locationByDay[] = [
                    'start' => $item->start,
                    'title' => __('Location') . ': ' . $location->name,
                    'className' => $color
                ];
            }
        }

        return $locationByDay;
    }
}
