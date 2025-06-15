<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::resource('employees', EmployeeController::class);
Route::get('employees-data', [EmployeeController::class, 'getData'])->name('employees.data');