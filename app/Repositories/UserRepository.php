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
        $fulltime = $this->getByShift($user, $dates, __('Fulltime'), config('site.shift.all'), config('site.calendar.fulltime-color'));
        $morning = $this->getByShift($user, $dates, __('Morning'), config('site.shift.morning'));
        $afternoon = $this->getByShift($user, $dates, __('Afternoon'), config('site.shift.afternoon'), config('site.calendar.afternoon-color'));
        $off = $this->getByShift($user, $dates, __('Off'), config('site.shift.off'), config('site.calendar.off-color'));

        return array_merge($fulltime, $morning, $afternoon, $off);
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
}
