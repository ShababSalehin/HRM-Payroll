<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\designations;
use DB;

class Designation extends Controller
{
    public function index()
    {
        $designations = designations::get();
        return view('employees.designations.designation_list', compact('designations'));
    }

    public function add_designation()
    {
        return view('employees.designations.add');
    }

    public function store(Request $request)
    {
        $data = array();
        $data['desig_name'] = $request['desig_name'];
        $data['desig_description'] = $request['desig_description'];
        $data['desig_short_name'] = $request['desig_short_name'];
        $data['desig_rank'] = $request['desig_rank'];
        designations::insert($data);
        return redirect()->route('designation_list');
        //return back();
    }

    public function edit_designation(Request $request, $id)
    {
        $designation_info = designations::findOrFail($id);
        return view('employees.designations.edit', compact('designation_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $designation = designations::findOrFail($id);
        // print_r($designation);
        // exit;

        $designation->desig_name = $request->desig_name;
        $designation->desig_description = $request->desig_description;
        $designation->desig_short_name = $request->desig_short_name;
        $designation->desig_rank = $request->desig_rank;

        $designation->save();
        return redirect()->route('designation_list');
    }


    public function view_designation(Request $request, $id)
    {
        $designation_info = designations::findOrFail($id);
        return view('employees.designations.view', compact('designation_info'));
    }


    public function destroy($id)
    {
        designations::destroy($id);
        return redirect()->route('designation_list');
    }
}
