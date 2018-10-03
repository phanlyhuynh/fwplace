<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PositionFormRequest;
use App\Repositories\PositionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PositionController extends Controller
{
    public $positionRepository;

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = $this->positionRepository->get();

        return view('admin.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionFormRequest $request)
    {
        $this->positionRepository->create($request->all());
        Alert::success(trans('Add new Position'), trans('Successfully!!!'));

        return redirect('admin/positions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = $this->positionRepository->findOrFail($id);

        return view('admin.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionFormRequest $request, $id)
    {
        $this->positionRepository->update($request->all(), $id);
        Alert::success(trans('Edit Position'), trans('Successfully!!!'));

        return redirect('admin/positions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->positionRepository->delete($id);
        Alert::success(trans('Delete Position'), trans('Successfully!!!'));

        return redirect('admin/positions');
    }
}
