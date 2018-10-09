<?php
/**
 * Created by PhpStorm.
 * User: lyhuynh
 * Date: 04/10/2018
 * Time: 09:53
 */

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
        $fulltime = $user->work_schedules()
            ->select(DB::raw('date as start, "' . __('Fulltime') . '" as title'))
            ->whereBetween('date', [$dates['start'], $dates['end']])
            ->where('shift', config('site.shift.all'))
            ->get()->toArray();
        $moring = $user->work_schedules()
            ->select(DB::raw('date as start, "' . __('Morning') . '" as title'))
            ->whereBetween('date', [$dates['start'], $dates['end']])
            ->where('shift', config('site.shift.morning'))
            ->get()->toArray();
        $afternoon = $user->work_schedules()
            ->select(DB::raw('date as start, "' . __('Afternoon') . '" as title'))
            ->whereBetween('date', [$dates['start'], $dates['end']])
            ->where('shift', config('site.shift.afternoon'))
            ->get()->toArray();
        $off = $user->work_schedules()
            ->select(DB::raw('date as start, "' . __('Off') . '" as title'))
            ->whereBetween('date', [$dates['start'], $dates['end']])
            ->where('shift', config('site.shift.off'))
            ->get()->toArray();

        return array_merge($fulltime, $moring, $afternoon, $off);
    }
}
