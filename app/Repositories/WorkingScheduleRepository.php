<?php

namespace App\Repositories;

class WorkingScheduleRepository extends EloquentRepository
{
    public function model()
    {
        return \App\Models\WorkSchedule::class;
    }
}
