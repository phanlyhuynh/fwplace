<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Repositories\LocationRepository;
use App\Repositories\SeatRepository;
use App\Repositories\WorkspaceRepository;

class DiagramController extends Controller
{
    public function __construct(
        LocationRepository $locationRepository,
        WorkspaceRepository $workspaceRepository,
        SeatRepository $seatRepository
    ) {
        $this->location = $locationRepository;
        $this->workspace = $workspaceRepository;
        $this->seat = $seatRepository;
    }

    public function typeWorkspaceInformation()
    {
        return view('test.workspace.create');
    }

    public function saveWorkspace(Request $request)
    {
        $workspace = $this->workspace->create([
            'name' => $request->name,
            'total_seat' => $request->total_seat,
            'seat_per_row' => $request->seat_per_row,
            'image' => '',
        ]);

        return redirect()->route('generate', ['id' => $workspace->id]);
    }

    public function generateDiagram(Request $request, $id)
    {
        $workspace = $this->workspace->findOrFail($id);
        $totalSeat = $workspace->total_seat;
        $seatPerRow = $workspace->seat_per_row;
        $remainderSeat = $totalSeat % $seatPerRow; // Lấy số ghế dư ra

        if ($remainderSeat > 0) {
            $totalRow = floor($totalSeat / $seatPerRow) + 1; // Lấy số hàng, nếu có dư thì +1 hàng để lưu số dư
        } else {
            $totalRow = floor($totalSeat / $seatPerRow);
        }

        $alphabet = range('A', 'Z'); // Tạo ra bảng chữ cái để đặt tên cho cột
        $columnName = $alphabet;
        if ($seatPerRow > count($alphabet)) {
            // Nếu như số ghế/hàng > bảng chữ cái thì sẽ kết hợp thêm 1 bảng chữ cái nữa: AA, AB, AC,...
            foreach ($alphabet as $char) {
                foreach ($alphabet as $additionalChar) {
                    $columnName[] = $char . $additionalChar;
                }
            }
        }

        $columnList = array_slice($columnName, 0, $seatPerRow); // Lấy danh sách tên các hàng
        $rowList = range(1, $totalRow); // Lấy danh sách tên các cột
        $renderSeat = [];
        $counting = 0; // Đếm số ghế được tạo ra
        foreach ($rowList as $key => $row) {
            foreach ($columnList as $column) {
                $counting++;
                if ($counting <= $totalSeat) { // Chưa max thì sẽ thêm
                    $renderSeat[$row][] = $column . $row;
                } else {
                    // Nếu max thì thêm để tạo đủ ghế
                    $renderSeat[$row][] = null;
                }
            }
        }

        return view('test.workspace.generate', compact('renderSeat', 'id'));
    }

    public function saveLocation(Request $request, $id)
    {
        $this->workspace->findOrFail($id);
        $seats = explode(',', $request->seats);
        $location = $this->location->create([
            'name' => $request->name,
            'workspace_id' => $id,
            'color' => $request->color,
        ]);
        
        foreach ($seats as $value) {
            $this->seat->create([
                'name' => $value,
                'location_id' => $location->id,
            ]);
        }

        return redirect()->back();
    }
}
