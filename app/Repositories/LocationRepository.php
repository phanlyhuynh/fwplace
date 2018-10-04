<?php

namespace App\Repositories;

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
}
