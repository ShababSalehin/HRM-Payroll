<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banks;
use App\Models\companies;
use DB;

class Bank extends Controller
{
    public function index()
    {

        $banks = banks::Join('companies', 'banks.id', '=', 'companies.id')
            ->select('banks.*', 'companies.name')
            ->get();
        return view('settings.banks.bank_list', compact('banks'));
    }

    public function add_bank()
    {
        $companies = companies::get();
        return view('settings.banks.add', compact('companies'));
    }

    public function store(Request $request)
    {
        $data = array();
        $data['name'] = $request['name'];
        $data['company_account'] = $request['company_account'];
        $data['branch_name'] = $request['branch_name'];
        $data['bank_type'] = $request['bank_type'];
        $data['routing_number'] = $request['routing_number'];
        $data['company_id'] = $request['company_id'];
        banks::insert($data);
        return redirect()->route('bank_list');
        //return back();
    }

    public function edit_bank(Request $request, $id)
    {
        $bank_info = banks::findOrFail($id);
        return view('settings.banks.edit', compact('bank_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $bank = banks::findOrFail($id);
        // print_r($bank);
        // exit;

        $bank->name = $request->name;
        $bank->company_account = $request->company_account;
        $bank->branch_name = $request->branch_name;
        $bank->bank_type = $request->bank_type;
        $bank->routing_number = $request->routing_number;

        $bank->save();
        return redirect()->route('bank_list');
    }


    public function view_bank(Request $request, $id)
    {
        $bank_info = banks::findOrFail($id);
        return view('settings.banks.view', compact('bank_info'));
    }


    public function destroy($id)
    {
        banks::destroy($id);
        return redirect()->route('bank_list');
    }
}
