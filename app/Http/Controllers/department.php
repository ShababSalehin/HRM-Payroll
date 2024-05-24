<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\departments;
use DB;

class Department extends Controller
{
    public function index()
    {
        $departments = departments::get();
        return view('employees.departments.department_list', compact('departments'));
    }

    public function add_department()
    {
        return view('employees.departments.add');
    }

    public function store(Request $request)
    {
        $data = array();
        $data['dept_name'] = $request['dept_name'];
        $data['dept_description'] = $request['dept_description'];
        $data['dept_short_name'] = $request['dept_short_name'];
        departments::insert($data);
        return redirect()->route('department_list');
        //return back();
    }

    public function edit_department(Request $request, $id)
    {
        $department_info = departments::findOrFail($id);
        return view('employees.departments.edit', compact('department_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $department = departments::findOrFail($id);
        // print_r($department);
        // exit;

        $department->dept_name = $request->dept_name;
        $department->dept_description = $request->dept_description;
        $department->dept_short_name = $request->dept_short_name;

        $department->save();
        return redirect()->route('department_list');
    }


    public function view_department(Request $request, $id)
    {
        $department_info = departments::findOrFail($id);
        return view('employees.departments.view', compact('department_info'));
    }


    public function destroy($id)
    {
        departments::destroy($id);
        return redirect()->route('department_list');
    }
}
