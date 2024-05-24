<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shifts;
use DB;

class shift extends Controller
{
    public function index()
    {
        $shifts = shifts::get();
        return view('employees.shifts.shift_list', compact('shifts'));
    }

    public function add_shift()
    {
        return view('employees.shifts.add');
    }

    public function store(Request $request)
    {
        $data = array();
        $data['shift'] = $request['shift'];
        $data['shiftCode'] = $request['shiftCode'];
        $data['startTime'] = $request['startTime'];
        $data['endTime'] = $request['endTime'];
        $data['weekend'] = $request['weekend'];
        $data['toShift'] = $request['toShift'];
        $data['intimeRange'] = $request['intimeRange'];
        $data['outtimeRange'] = $request['outtimeRange'];
        shifts::insert($data);
        return redirect()->route('shift_list');
        //return back();
    }

    public function edit_shift(Request $request, $id)
    {
        $shift_info = shifts::findOrFail($id);
        return view('employees.shifts.edit', compact('shift_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $shift = shifts::findOrFail($id);
        // print_r($shift);
        // exit;

        $shift->shift = $request->shift;
        $shift->shiftCode = $request->shiftCode;
        $shift->startTime = $request->startTime;
        $shift->endTime = $request->endTime;
        $shift->weekend = $request->weekend;
        $shift->toShift = $request->toShift;
        $shift->intimeRange = $request->intimeRange;
        $shift->outtimeRange = $request->outtimeRange;;

        $shift->save();
        return redirect()->route('shift_list');
    }


    public function view_shift(Request $request, $id)
    {
        $shift_info = shifts::findOrFail($id);
        return view('employees.shifts.view', compact('shift_info'));
    }


    public function destroy($id)
    {
        shifts::destroy($id);
        return redirect()->route('shift_list');
    }
}
