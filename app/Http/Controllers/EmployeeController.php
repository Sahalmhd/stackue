<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.form', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        return view('employees.form', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->validated());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['success' => true]);
    }

    public function getData(Request $request)
    {
        $columns = ['employee_govt_id', 'first_name', 'email', 'department_id', 'hire_date', 'status'];

        $search = $request->input('search.value');
        $orderColumnIndex = $request->input('order.0.column', 1);
        $orderColumn = $columns[$orderColumnIndex] ?? 'first_name';
        $orderDir = $request->input('order.0.dir', 'asc');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = Employee::with('department');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('employee_govt_id', 'like', "%{$search}%");
            });
        }

        $total = $query->count();

        $employees = $query->orderBy($orderColumn, $orderDir)
            ->skip($start)
            ->take($length)
            ->get();

        $data = $employees->map(function ($employee) {
            return [
                'employee_govt_id' => $employee->employee_govt_id,
                'full_name' => $employee->full_name,
                'email' => $employee->email,
                'department' => $employee->department->name ?? '',
                'hire_date' => $employee->hire_date->format('Y-m-d'),
                'status' => ucfirst($employee->status),
                'actions' => '
                <a href="' . route('employees.edit', $employee->id) . '" class="btn btn-sm btn-primary">Edit</a>
                <button class="btn btn-sm btn-danger delete-employee" data-id="' . $employee->id . '">Delete</button>

            ',
            ];
        });

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }
}
