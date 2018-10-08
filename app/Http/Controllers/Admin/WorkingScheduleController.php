<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;

class WorkingScheduleController extends Controller
{
    public function __construct(LocationRepository $locationRepository)
    {
        $this->location = $locationRepository;
    }

    public function viewByLocation($location_id)
    {
        $location = $this->location->findOrFail($location_id);

        return view('admin.calendars.location', compact('location'));
    }

    public function getCalendar(Request $request, $location_id)
    {
        $location = $this->location->findOrFail($location_id);

        return response()->json($location);
    }
}
