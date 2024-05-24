<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sections;
use App\Models\departments;
use DB;

class Section extends Controller
{
    public function index()
    {
        $sections = sections::Join('departments', 'sections.id', '=', 'departments.id')
            ->select('sections.*', 'departments.name')
            ->get();
        return view('employees.sections.section_list', compact('sections'));
    }


    public function add_section()
    {
        $departments = departments::get();
        return view('employees.sections.add', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = array();
        $data['id'] = $request['id'];
        $data['section_name'] = $request['section_name'];
        $data['description'] = $request['description'];
        sections::insert($data);
        return redirect()->route('section_list');
        //return back();
    }

    public function edit_section(Request $request, $id)
    {
        $section_info = sections::findOrFail($id);
        return view('employees.sections.edit', compact('section_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $section = sections::findOrFail($id);
        // print_r($section);
        // exit;

        $section->section_name = $request->section_name;
        $section->description = $request->description;

        $section->save();
        return redirect()->route('section_list');
    }


    public function view_section(Request $request, $id)
    {
        $section_info = sections::findOrFail($id);
        return view('employees.sections.view', compact('section_info'));
    }


    public function destroy($id)
    {
        sections::destroy($id);
        return redirect()->route('section_list');
    }
}
