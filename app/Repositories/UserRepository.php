<?php
/**
 * Created by PhpStorm.
 * User: lyhuynh
 * Date: 04/10/2018
 * Time: 09:53
 */

namespace App\Repositories;


use App\User;

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
}
