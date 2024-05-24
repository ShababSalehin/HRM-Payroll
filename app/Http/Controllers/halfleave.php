<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\halfleaves;
use App\Models\employees;
use DB;

class halfleave extends Controller
{
    public function index()
    {
        $halfleave = halfleaves::Join('employees', 'halfleaves.employeeId', '=', 'employees.id')
            ->select('halfleaves.*', 'employees.name')
            ->get();
        return view('leaves.halfleaves.halfleave_list', compact('halfleave'));
    }

    public function add_leave()
    {
        $employees = employees::get();
        return view('leaves.halfleaves.add_leave', compact('employees'));
    }

    public function store(Request $request)
    {
        $data = array();
        $data['id'] = $request['id'];
        $data['employeeId'] = $request['employeeId'];
        $data['date'] = $request['date'];
        $data['startTime'] = $request['startTime'];
        $data['endTime'] = $request['endTime'];
        $data['reason'] = $request['reason'];

        halfleaves::insert($data);
        return redirect()->route('halfleave_list')->with('message', 'Added successfully!');
        //return back();
    }

    public function edit_leave(Request $request, $id)
    {
        // echo $id;
        // exit;
        $employees = employees::get();
        $leave_info = halfleaves::findOrFail($id);
        // print_r($leave_info);
        // exit;
        return view('leaves.halfleaves.edit_leave', compact('leave_info', 'employees'));
    }



    public function update(Request $request)
    {
        $id = $request->id;
        $halfleave = halfleaves::findOrFail($id);
        // print_r($leave);
        // exit;

        $halfleave->employeeId = $request->employeeId;
        $halfleave->date = $request->date;
        $halfleave->startTime = $request->startTime;
        $halfleave->endTime = $request->endTime;
        $halfleave->reason = $request->reason;

        //    echo '<pre>';
        //    print_r($leave);
        //    exit;outtimeRange

        $halfleave->save();
        return redirect()->route('halfleave_list')->with('message', 'Updated successfully!');
    }


    public function view_leave(Request $request, $id)
    {
        $employees = employees::get();
        $leave_info = halfleaves::findOrFail($id);
        return view('leaves.halfleaves.view_leave', compact('leave_info', 'employees'));
    }


    public function destroy($id)
    {
        halfleaves::destroy($id);
        return redirect()->route('halfleave_list')->with('message', 'Deleted successfully!');
    }
}
