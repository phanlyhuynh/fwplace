<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;
use App\Repositories\UserRepository;
use App\Repositories\WorkspaceRepository;
use App\Repositories\ProgramRepository;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class SittingCalendarController extends Controller
{

    public function __construct(
        LocationRepository $locationRepository, 
        UserRepository $userRepository, 
        WorkspaceRepository $workspaceRepository,
        ProgramRepository $programRepository
    )
    {
        $this->location = $locationRepository;
        $this->user = $userRepository;
        $this->workspace = $workspaceRepository;
        $this->program = $programRepository;
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

    public function locationAnalystic(Request $request, $location_id)
    {
        $request->session()->forget('ws_program_id');
        $location = $this->location->findOrFail($location_id);
        $programs = $this->program->listProgram();
        if ($request->has('program_id')) {
            $request->session()->put('ws_program_id', $request->program_id);
        }

        return view('admin.calendar.analystic', compact('location', 'programs'));
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
        if ($request->session()->has('ws_program_id')) {
            $filter['program_id'] = $request->session()->get('ws_program_id');
        }
        $data = $this->location->getData($location_id, $filter);
        
        return $data;
    }

    public function detailLocation(Request $request, $locationId, $date)
    {
        $location = $this->location->findOrFail($locationId);
        $filter = [
            'location_id' => $locationId,
            'date' => $date,
        ];
        if ($request->has('program_id')) {
            $filter['program_id'] = $request->program_id;
        }
        if ($request->has('shift')) {
            $filter['shift'] = $request->shift;
        }
        $data = $this->location->getLocationDetail($filter);
        $programs = $this->program->listProgram();

        return view('admin.calendar.detailLocation', compact('data', 'location', 'date', 'programs'));
    }
}
