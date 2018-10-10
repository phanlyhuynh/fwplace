<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Repositories\WorkingScheduleRepository;

class WorkScheduleController extends Controller
{
	public function __construct(WorkingScheduleRepository $workingScheduleRepository)
	{
		$this->workingSchedule = $workingScheduleRepository;
	}

    public function index()
    {
        $dates = [];
        for ($i = 0 ; $i < 31; $i++) { 
            $day = Carbon::now()->startOfMonth()->addDay($i);
            if (!$day->isWeekend()) {
                $dates[] = [
                    'date' => $day->format('Y-m-d'),
                    'day' => $day->format('l'),
                    'format' => $day->format('d-m-Y')
                ];
            } else {
                $dates[] = [
                    'date' => $day->format('Y-m-d'),
                    'day' => $day->format('l'),
                    'format' => $day->format('d-m-Y'),
                    'weekend' => true
                ];
            }
        }

        $data = $this->workingSchedule->getUserSchedule(Auth::user()->id);

        return view('users.registerworkschedules', compact('dates', 'data') );
    }

    public function registerWork(Request $request)
    {
    	$data = $request->all();
    	foreach ($data['shift'] as $key => $value) {
			$request->user()->work_schedules()->updateOrCreate(
				[
	    			'date' => $key,
	    		],
	    		[
	    			'shift' => $value
	    		]
    		);
    	}

    	return redirect()->back();
    }
}

