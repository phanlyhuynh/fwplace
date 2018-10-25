<?php

namespace App\Repositories;

class SeatRepository extends EloquentRepository
{
    public function model()
    {
        return \App\Models\Seat::class;
    }
}
