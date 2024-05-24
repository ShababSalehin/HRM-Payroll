<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\companies;
use DB;

class Company extends Controller
{
    public function index()
    {    
        $companies=companies::get();
        return view('settings.companies.company_list',compact('companies'));
    }

    public function add_company()
    {    
        return view('settings.companies.add');
    }

    public function store(Request $request)
    {  
        $data=array();  
        $data['name'] = $request['name'];
        $data['code'] = $request['code'];
        $data['address'] = $request['address'];
        $data['phone'] = $request['phone'];
        $data['email'] = $request['email'];
        companies::insert($data);
        return redirect()->route('company_list');
        //return back();
    }

    public function edit_company(Request $request, $id)
    {    
        $company_info= companies::findOrFail($id);
        return view('settings.companies.edit',compact('company_info'));
    }

    public function update(Request $request)
    {  
        $id=$request->id;
        $company = companies::findOrFail($id);
        // print_r($company);
        // exit;
        
        $company->name = $request->name;
        $company->code = $request->code;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;

        $company->save();   
        return redirect()->route('company_list');
        
    }


    public function view_company(Request $request, $id)
    {    
        $company_info= companies::findOrFail($id);    
        return view('settings.companies.view',compact('company_info'));
    }


    public function destroy($id)
    {
        companies::destroy($id);
        return redirect()->route('company_list');
    }

}
