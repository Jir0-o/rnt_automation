<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RequisitionProduct;
use Illuminate\Http\Request;

class RequisitionProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with('unitType')->find($id);
        
            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'No data found',
                    'data' => null,
                ], 404);
            }
        
            $requisitionProducts = RequisitionProduct::where('product_id', $id)->get();
        
            return response()->json([
                'status' => true,
                'message' => 'Requisition products fetched successfully',
                'data' => $product,
                'requisitionProducts' => $requisitionProducts,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch requisition products',
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
