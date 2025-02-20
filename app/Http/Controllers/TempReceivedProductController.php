<?php

namespace App\Http\Controllers;

use App\Models\TempReceivedProduct;
use Illuminate\Http\Request;

class TempReceivedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tempRequestedProducts = TempReceivedProduct::where('user_id', auth()->user()->id)
                ->with(['product'])
                ->orderBy('id', 'DESC')
                ->get();

                if(!$tempRequestedProducts){
                    return response()->json([
                        'status' => false,
                        'message' => 'No data found',
                        'data' => []
                    ], 404);
                }

            return response()->json([
                'status' => true,
                'message' => 'Temp requested products fetched successfully',
                'data' => $tempRequestedProducts
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch temp requested products',
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
            $tempRequestedProduct = TempReceivedProduct::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->user()->id,
                'quantity' => $request->quantity,
                'unit_price' => $request->price,
                'total_price' => $request->quantity * $request->price
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Temp requested product added successfully',
                'data' => $tempRequestedProduct
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to add temp requested product',
                'error' => $e->getMessage()
            ], 500);
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
        try {
            $tempRequestedProduct = TempReceivedProduct::find($id);

            if (!$tempRequestedProduct) {
                return response()->json([
                    'status' => false,
                    'message' => 'Temp requested product not found',
                    'data' => []
                ], 404);
            }

            //calculate total price
            $totalPrice = $request->quantity *  $request->price;

            $tempRequestedProduct->update([
                'unit_price' => $request->price,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Temp requested product updated successfully',
                'data' => $tempRequestedProduct
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update temp requested product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tempRequestedProduct = TempReceivedProduct::find($id);

            if(!$tempRequestedProduct) {
                return response()->json([
                    'status' => false,
                    'message' => 'Temp requested product not found',
                    'data' => []
                ], 404);
            }

            $tempRequestedProduct->delete();

            return response()->json([
                'status' => true,
                'message' => 'Temp requested product deleted successfully',
                'data' => $tempRequestedProduct
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete temp requested product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
