<?php

namespace App\Repositories;

use App\Models\Position;

class PositionRepository extends EloquentRepository
{
    public function model()
    {
        return Position::class;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function listpositionArray()
    {
        return $this->model->pluck('name', 'id')->toArray();
    }

    public function pluckPosition()
    {
        return $this->model->pluck('name', 'id');
    }
}
