<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class employee extends Controller
{
    public function index()
    {
        return view('employees.employee_list');
    }
}
