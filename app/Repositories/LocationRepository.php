<?php

namespace App\Repositories;

class LocationRepository extends EloquentRepository
{
    public function model()
    {
        return \App\Models\Location::class;
    }

    public function listLocation()
    {
        return $this->model->with('workspace')->latest()->paginate(config('database.paginate'));
    }
}
