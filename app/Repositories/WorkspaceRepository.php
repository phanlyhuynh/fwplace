<?php

namespace App\Repositories;

class WorkspaceRepository extends EloquentRepository
{
    public function model()
    {
        return \App\Models\Workspace::class;
    }

    public function getWorkspaces()
    {
        return $this->model->latest()->get();
    }
}
