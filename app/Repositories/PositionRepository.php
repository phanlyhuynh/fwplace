<?php
/**
 * Created by PhpStorm.
 * User: lyhuynh
 * Date: 03/10/2018
 * Time: 11:00
 */

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
}
