<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;
use App\Repositories\WorkspaceRepository;
use App\Repositories\ProgramRepository;
use Carbon\Carbon;

class WorkingScheduleController extends Controller
{
    public function __construct(
        LocationRepository $locationRepository, 
        WorkspaceRepository $workspaceRepository, 
        UserRepository $userRepository, 
        ProgramRepository $programRepository)
    {
        $this->location = $locationRepository;
        $this->workspace = $workspaceRepository;
        $this->userRepository = $userRepository;
        $this->program = $programRepository;
    }

    public function viewByWorkplace(Request $request, $workspace_id)
    {
        $request->session()->forget('ws_program_id');
        $workspace = $this->workspace->findOrFail($workspace_id);
        $programs = $this->program->listProgram();
        if ($request->has('program_id')) {
            $request->session()->put('ws_program_id', $request->program_id);
        }

        return view('admin.work_schedules.workspace', compact('workspace', 'programs'));
    }

    public function getData(Request $request, $workspace_id)
    {
        $workspace = $this->workspace->findOrFail($workspace_id);
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
        $data = $this->workspace->getData($workspace_id, $filter);

        return $data;
    }

    public function chooseWorkplace()
    {
        $workspaces = $this->workspace->getWorkspaces();

        return view('admin.work_schedules.choose_workspace', compact('workspaces'));
    }

    public function viewByUser($user_id)
    {
        $user = $this->userRepository->findOrFail($user_id);

        return view('admin.user.timesheet', compact('user'));
    }

    public function getDataUser(Request $request, $user_id)
    {
        $this->validate(
            $request,
            [
                'start' => 'required',
                'end' => 'required'
            ]
        );
        $dates = [
            'start' => $request->start,
            'end' => $request->end
        ];
        $data = $this->userRepository->getDataUserTimesheet($user_id, $dates);

        return $data;
    }

    public function getOneDate(Request $request, $workspace_id)
    {
        $workspace = $this->workspace->findOrFail($workspace_id);
        $this->validate(
            $request,
            [
                'date' => 'required|date'
            ]
        );
        if (Carbon::parse($request->date)->isWeekend()) {
            return response()->json(null);
        }
        $data = $this->workspace->getOneDate($workspace_id, $request->date);

        return $data;
    }
}
