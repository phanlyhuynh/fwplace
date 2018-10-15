<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;
use App\Repositories\UserRepository;
use App\Repositories\WorkspaceRepository;
use Carbon\CarbonPeriod;

class SittingCalendarController extends Controller
{

    public function __construct(
        LocationRepository $locationRepository, 
        UserRepository $userRepository, 
        WorkspaceRepository $workspaceRepository
    )
    {
        $this->location = $locationRepository;
        $this->user = $userRepository;
        $this->workspace = $workspaceRepository;
    }

    public function chooseWorkplace()
    {
        $workspaces = $this->workspace->getWorkspaces();

        return view('admin.calendar.choose_workspace', compact('workspaces'));
    }

    public function locationList($workspace_id)
    {
        $workspace = $this->workspace->findOrFail($workspace_id);
        $location_list = $this->workspace->getListLocation($workspace_id);

        return view('admin.calendar.choose_location', compact('location_list', 'workspace'));
    }

    public function locationAnalystic($location_id)
    {
        $location = $this->location->findOrFail($location_id);

        return view('admin.calendar.analystic', compact('location'));
    }

    public function getAnalysticData(Request $request, $location_id)
    {
        $location = $this->location->findOrFail($location_id);
        $this->validate(
            $request,
            [
                'start' => 'required',
                'end' => 'required'
            ]
        );
        $filter = [
            'start' => $request->start,
            'end' => $request->end
        ];
        $data = $this->location->getData($location_id, $filter);
        
        return $data;
    }
}
