<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::get('/', 'home@index');
Route::get('/employee', 'employee@index')->name('employee_list');

Route::get('/designation', 'designation@index')->name('designation_list');
Route::get('/add_designation', 'designation@add_designation')->name('designation_add');
Route::post('/add_designation_action', 'designation@store')->name('designation_add_action');
Route::get('/edit_designation/{id}', 'designation@edit_designation')->name('edit_designation');
Route::get('/view_designation/{id}', 'designation@view_designation')->name('view_designation');
Route::post('/update_designation', 'designation@update')->name('update_designation');
Route::get('/designation_delete/{id}', 'designation@destroy')->name('designation_delete');

Route::get('/department', 'department@index')->name('department_list');
Route::get('/add_department', 'department@add_department')->name('department_add');
Route::post('/add_department_action', 'department@store')->name('department_add_action');
Route::get('/edit_department/{id}', 'department@edit_department')->name('edit_department');
Route::get('/view_department/{id}', 'department@view_department')->name('view_department');
Route::post('/update_department', 'department@update')->name('update_department');
Route::get('/department_delete/{id}', 'department@destroy')->name('department_delete');

Route::get('/section', 'section@index')->name('section_list');
Route::get('/add_section', 'section@add_section')->name('section_add');
Route::post('/add_section_action', 'section@store')->name('section_add_action');
Route::get('/edit_section/{id}', 'section@edit_section')->name('edit_section');
Route::get('/view_section/{id}', 'section@view_section')->name('view_section');
Route::post('/update_section', 'section@update')->name('update_section');
Route::get('/section_delete/{id}', 'section@destroy')->name('section_delete');

Route::get('/shift', 'shift@index')->name('shift_list');
Route::get('/add_shift', 'shift@add_shift')->name('shift_add');
Route::post('/add_shift_action', 'shift@store')->name('shift_add_action');
Route::get('/edit_shift/{id}', 'shift@edit_shift')->name('edit_shift');
Route::get('/view_shift/{id}', 'shift@view_shift')->name('view_shift');
Route::post('/update_shift', 'shift@update')->name('update_shift');
Route::get('/shift_delete/{id}', 'shift@destroy')->name('shift_delete');

Route::get('/leavetype', 'leavetype@index')->name('leave_list');
Route::get('/add_leavetype', 'leavetype@add_leave')->name('leave_add');
Route::post('/add_leavetype_action', 'leavetype@store')->name('leave_add_action');
Route::get('/edit_leavetype/{id}', 'leavetype@edit_leave')->name('edit_leave');
Route::get('/view_leavetype/{id}', 'leavetype@view_leave')->name('view_leave');
Route::post('/update_leavetype', 'leavetype@update')->name('update_leave');
Route::get('/leavetype_delete/{id}', 'leavetype@destroy')->name('leave_delete');

Route::get('/halfleave', 'halfleave@index')->name('halfleave_list');
Route::get('/add_halfleave', 'halfleave@add_leave')->name('halfleave_add');
Route::post('/add_halfleave_action', 'halfleave@store')->name('halfleave_add_action');
Route::get('/edit_halfleave/{id}', 'halfleave@edit_leave')->name('edit_halfleave');
Route::get('/view_halfleave/{id}', 'halfleave@view_leave')->name('view_halfleave');
Route::post('/update_halfleave', 'halfleave@update')->name('update_halfleave');
Route::get('/halfleave_delete/{id}', 'halfleave@destroy')->name('halfleave_delete');


Route::get('/bank', 'bank@index')->name('bank_list');
Route::get('/add_bank', 'bank@add_bank')->name('bank_add');
Route::post('/add_bank_action', 'bank@store')->name('bank_add_action');
Route::get('/edit_bank/{id}', 'bank@edit_bank')->name('edit_bank');
Route::get('/view_bank/{id}', 'bank@view_bank')->name('view_bank');
Route::post('/update_bank', 'bank@update')->name('update_bank');
Route::get('/bank_delete/{id}', 'bank@destroy')->name('bank_delete');

Route::get('/company', 'company@index')->name('company_list');
Route::get('/add_company', 'company@add_company')->name('company_add');
Route::post('/add_company_action', 'company@store')->name('company_add_action');
Route::get('/edit_company/{id}', 'company@edit_company')->name('edit_company');
Route::get('/view_company/{id}', 'company@view_company')->name('view_company');
Route::post('/update_company', 'company@update')->name('update_company');
Route::get('/company_delete/{id}', 'company@destroy')->name('company_delete');
