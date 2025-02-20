<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TempRequisitionProduct;
use Illuminate\Http\Request;

class PurchaseControlle extends Controller
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
        return view('backend.purchases.purchases');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //get all temp requisition products based on user id
            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)->get();

            if ($tempRequestedProducts) {
                foreach ($tempRequestedProducts as $tempRequestedProduct) {
                    $products = Product::where('id', $tempRequestedProduct->product_id)->first();

                    $products->request_quantity = $products->request_quantity + $tempRequestedProduct->quantity;
                    $products->save();
                }

                //delete all temp requisition products based on user id
                TempRequisitionProduct::where('user_id', auth()->user()->id)->delete();
            }

            return response()->json([
                'status' => true,
                'message' => 'Product sub categories retrieved successfully',
                'data' => $tempRequestedProducts
            ], 200);

        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve product sub categories',
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
