<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $departments = Department::all();
            
            return response()->json([
                'status' => true,
                'message' => 'Departments fetched successfully',
                'data' => $departments
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch departments',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = Department::orderBy('id', 'desc')
        ->with('head')
        ->get();

        $users = User::all();

        return view('backend.file_tracking.head', compact('department', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeDeparment(Request $request)
    {

        Log::info('Department ID: ' . $request->id . ' Head ID: ' . $request->head_id);

        $request->validate([
            'id' => 'required|exists:departments,id',
            'head_id' => 'required|exists:users,id',
        ]);

        try {
            $department = Department::find($request->id);
            $department->head_id = $request->head_id;
            $department->save();

            // Update the department head in the users table
            $users = User::where('department_id', $request->id)->get();
            foreach ($users as $user) {
                $user->update(['auth_by' => $request->head_id]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Department updated successfully',
                'data' => $department
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update department',
                'error' => $e->getMessage()
            ]);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function departmentShow()
    {
        $department = Department::where('code',1)->get();

        return view('backend.department.department', compact('department'));

    }
    public function departmentStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'department_name' => 'required|string|max:255',
                'department_short_name' => 'required|string|max:255',
            ]);
    
            $department = new Department();
            $department->name = $validated['department_name'];
            $department->short_name = $validated['department_short_name'];
            $department->code = 1;
            $department->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Department created successfully',
                'data' => $department
            ], 201); 
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create Department',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function departmentEditShow(string $id)
    {
        try {
            $department = Department::find($id);
    
            if (!$department) {
                return response()->json([
                    'status' => false,
                    'message' => 'Department not found',
                    'data' => null
                ], 404);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Department retrieved successfully',
                'department' => $department
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve Department',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function departmentUpdate(Request $request, string $id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return response()->json([
                    'status' => false,
                    'message' => 'Department not found',
                    'data' => null
                ], 404);
            }

            $validated = $request->validate([
                'department_name' => 'required|string|max:255',
                'department_short_name' => 'required|string|max:255',
            ]);

            $department->name = $validated['department_name'];
            $department->short_name = $validated['department_short_name'];
            $department->save();

            return response()->json([
                'status' => true,
                'message' => 'Department updated successfully',
                'data' => $department
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update product sub category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function departmentDestroy(string $id)
    {
        try {
            $department = Department::find($id);
    
            if (!$department) {
                return response()->json([
                    'status' => false,
                    'message' => 'Department not found',
                    'data' => null
                ], 404);
            }
            $department->code = 0;
            $department->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Department deleted successfully',
                'data' => null
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete Department',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
