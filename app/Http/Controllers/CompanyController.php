<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Requisition;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::where('is_active', 1)->get();
        return view('company.createCompany', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $company = Company::where('is_active', 1)->get();

            return response()->json([
                'status' => true,
                'message' => 'Company retrieved successfully',
                'company' => $company
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve Company',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'company_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'buyer_name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);


            $company = new Company();
            $company->name = $validated['company_name'];
            $company->address = $validated['address'];
            $company->buyer_name = $validated['buyer_name'];
            $company->description = $validated['description'];
            $company->status = 1;
            $company->is_active = 1;
            $company->save();

            

            return response()->json([
                'status' => true,
                'message' => 'Category Create successfully',
                'data' => $company
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch Category data',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $company = Company::find($id);
    
            if (!$company) {
                return response()->json([
                    'status' => false,
                    'message' => 'Company not found',
                    'data' => null
                ], 404);
            }
             
            return response()->json([
                'status' => true,
                'message' => 'Company retrieved successfully',
                'company' => $company
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve Company',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            $company = Company::find($id);

            if (!$company) {
                return response()->json([
                    'status' => false,
                    'message' => 'Company not found',
                    'data' => null
                ], 404);
            }

            $validated = $request->validate([
                'company_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'buyer_name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $company->name = $validated['company_name'];
            $company->address = $validated['address'];
            $company->buyer_name = $validated['buyer_name'];
            $company->description = $validated['description'];
            $company->save();

            return response()->json([
                'status' => true,
                'message' => 'Company updated successfully',
                'data' => $company
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update Company',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function companyRecords()
    {
        $requisitions = Requisition::with(['requisitionProducts.product', 'user', 'company'])
        ->orderBy('id', 'DESC')
        ->get();

        // Fetch all companies and users to display in the dropdowns
        $companies = Company::all();
        $users = User::all();

        return view('company.companyRecords', compact('requisitions', 'companies', 'users'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $company = Company::find($id);
    
            if (!$company) {
                return response()->json([
                    'status' => false,
                    'message' => 'Company not found',
                    'data' => null
                ], 404);
            }

    
            $company->is_active = 0;
            $company->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Company deleted successfully',
                'data' => null
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete Company',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
