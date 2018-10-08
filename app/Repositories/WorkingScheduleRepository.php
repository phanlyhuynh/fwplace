<?php

namespace App\Repositories;

class WorkspaceRepository extends EloquentRepository
{
    public function model()
    {
        return \App\Models\WorkSchedule::class;
    }
}
