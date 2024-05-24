<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leavetypes;
use DB;

class leavetype extends Controller
{
    public function index()
    {
        $leave = leavetypes::get();
        return view('leaves.leavetypes.leave_list', compact('leave'));
    }

    public function add_leave()
    {
        return view('leaves.leavetypes.add_leave');
    }

    public function store(Request $request)
    {
        $data = array();
        $data['id'] = $request['id'];
        $data['name'] = $request['name'];
        $data['short_name'] = $request['short_name'];
        $data['description'] = $request['description'];
        $data['allowedLeave'] = $request['allowedLeave'];

        leavetypes::insert($data);
        return redirect()->route('leave_list')->with('message', 'Added successfully!');
        //return back();
    }

    public function edit_leave(Request $request, $id)
    {
        $leave_info = leavetypes::findOrFail($id);
        return view('leaves.leavetypes.edit_leave', compact('leave_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $leave = leavetypes::findOrFail($id);
        // print_r($leave);
        // exit;

        $leave->name = $request->name;
        $leave->short_name = $request->short_name;
        $leave->description = $request->description;
        $leave->allowedLeave = $request->allowedLeave;
        //    echo '<pre>';
        //    print_r($leave);
        //    exit;outtimeRange

        $leave->save();
        return redirect()->route('leave_list')->with('message', 'Updated successfully!');
    }


    public function view_leave(Request $request, $id)
    {
        $leave_info = leavetypes::findOrFail($id);
        return view('leaves.leavetypes.view_leave', compact('leave_info'));
    }


    public function destroy($id)
    {
        leavetypes::destroy($id);
        return redirect()->route('leave_list')->with('message', 'Deleted successfully!');
    }
}
