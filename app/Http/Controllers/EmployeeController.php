<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::query();

        // Filter dan Pencarian
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $employees->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%$searchTerm%")
                    ->orWhere('position', 'like', "%$searchTerm%");
            });
        }

        // Pengurutan
        if ($request->has('sort_by') && $request->has('order')) {
            $sortField = $request->sort_by;
            $sortOrder = $request->order;
            $employees->orderBy($sortField, $sortOrder);
        }

        return view('employees.index', [
            'employees' => $employees->paginate(500),
        ]);
    }

    public function getEmployeeData(Request $request)
    {
        $employees = Employee::query();

        // Handle search term
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $employees->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                      ->orWhere('position', 'like', '%' . $searchValue . '%');
            });
        }

        // Handle ordering
        if ($request->has('order')) {
            $orderColumnIndex = $request->order[0]['column'];
            $orderDirection = $request->order[0]['dir'];
            $orderColumnName = $request->columns[$orderColumnIndex]['data'];
            $employees->orderBy($orderColumnName, $orderDirection);
        }

        // Fetch records
        $recordsTotal = $employees->count();
        $employees = $employees->skip($request->input('start'))
                               ->take($request->input('length'))
                               ->get();

        // Prepare data for DataTables
        $data = [];
        foreach ($employees as $employee) {
            $data[] = [
                'name' => $employee->name,
                'position' => $employee->position,
                'hire_date' => $employee->hire_date,
                'salary' => $employee->salary,
                'actions' => '<a href="' . route('employees.edit', $employee->id) . '" class="btn btn-warning btn-sm">Edit</a>'
                             . '<form action="' . route('employees.destroy', $employee->id) . '" method="POST" style="display:inline-block;">'
                             . csrf_field()
                             . method_field('DELETE')
                             . '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>'
                             . '</form>'
            ];
        }

        // Prepare JSON response
        $response = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $data,
        ];

        return response()->json($response);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}

