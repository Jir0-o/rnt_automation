<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Models\TempAllocatedProduct;
use Illuminate\Http\Request;

class TempAllocatedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tempAllocatedProducts = TempAllocatedProduct::where('user_id', auth()->user()->id)
                ->with(['product'])
                ->orderBy('id', 'DESC')
                ->get();

            if (!$tempAllocatedProducts) {
                return response()->json([
                    'status' => false,
                    'message' => 'No data found',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Temp allocated products fetched successfully',
                'data' => $tempAllocatedProducts
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch temp allocated products',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {

            $allTempAllocatedProducts = TempAllocatedProduct::where('requisition_id', $request->requisition_id)->get();

            if($allTempAllocatedProducts) {
                foreach($allTempAllocatedProducts as $tempAllocatedProduct) {
                    if($tempAllocatedProduct->product_id == $request->product_id) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Product already allocated',
                            'data' => []
                        ], 400);
                    }
                }
            }

            $getUserId = Requisition::where('id', $request->requisition_id)->first();

            $tempAllocatedProduct = new TempAllocatedProduct();
            $tempAllocatedProduct->user_id = $getUserId->user_id;
            $tempAllocatedProduct->product_id = $request->product_id;
            $tempAllocatedProduct->quantity = $request->quantity;
            $tempAllocatedProduct->requisition_id = $request->requisition_id;
            $tempAllocatedProduct->unit_price = (float) $request->unit_price;
            $tempAllocatedProduct->total_price = $request->quantity * (float) $request->unit_price;
            $tempAllocatedProduct->spec = null;
            $tempAllocatedProduct->save();

            return response()->json([
                'status' => true,
                'message' => 'Product allocated successfully',
                'data' => $tempAllocatedProduct
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to allocate product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $tempAllocatedProducts = TempAllocatedProduct::where('requisition_id', $id)
                ->with(['product'])
                ->orderBy('id', 'DESC')
                ->get();

            if (!$tempAllocatedProducts) {
                return response()->json([
                    'status' => false,
                    'message' => 'No data found',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Temp allocated products fetched successfully',
                'data' => $tempAllocatedProducts
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch temp allocated products',
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
        try {
            $tempAllocatedProduct = TempAllocatedProduct::find($id);

            if (!$tempAllocatedProduct) {
                return response()->json([
                    'status' => false,
                    'message' => 'Temp allocated product not found',
                    'data' => []
                ], 404);
            }

            $tempAllocatedProduct->delete();

            return response()->json([
                'status' => true,
                'message' => 'Temp allocated product deleted successfully',
                'data' => $tempAllocatedProduct
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete temp allocated product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
