<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;
use App\Repositories\UserRepository;

class SittingCalendarController extends Controller
{

    public function __construct(LocationRepository $locationRepository, UserRepository $userRepository)
    {
        $this->location = $locationRepository;
        $this->user = $userRepository;
    }

    public function scheduling($location_id)
    {
        $location = $this->location->findOrFail($location_id);
        $users = $this->user->get();

        return view('admin.calendar.scheduling', compact('location', 'users'));
    }
}
