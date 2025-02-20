<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Requisition;
use App\Models\RequisitionProduct;
use App\Models\TempReceivedProduct;
use App\Models\TempRequestedProduct;
use App\Models\TempRequisitionProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class TempRequestedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        try {
            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)
                ->where('is_active', 1)
                ->with(['product.unitType'])
                ->orderBy('id', 'ASC')
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

            $product = Product::find($request->product_id);

            $tempRequestedProduct = TempRequisitionProduct::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->user()->id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'unit_type' => $product->unit_type_id,
                'total' => $request->quantity * $request->price,
                'spec' => $request->spec,
                'unit_price' => $request->unit_price,
                'unit_package_size' => $request->unit_package_size,
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
        try {
            $tempRequestedProduct = RequisitionProduct::where('requisition_id', $id)->with('product', 'unitType')->get();

            // Initialize $allProduct as an empty collection
            $allProduct = collect();

            // Loop through each product in $tempRequestedProduct
            foreach ($tempRequestedProduct as $key => $products) {
                $matchedProducts = Product::where('is_active', 1)
                    ->where('product_name', 'like', '%' . $products->product->product_name . '%')
                    ->get();
                
                // Merge the matched products into the $allProduct collection
                $allProduct = $allProduct->merge($matchedProducts);
            }

            if (!$tempRequestedProduct) {
                return response()->json([
                    'status' => false,
                    'message' => 'Temp requested product not found',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Temp requested product fetched successfully',
                'data' => $tempRequestedProduct,
                'allProduct' => $allProduct
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch temp requested product',
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
            $tempRequestedProduct = TempRequisitionProduct::find($id);

            if (!$tempRequestedProduct) {
                return response()->json([
                    'status' => false,
                    'message' => 'Temp requested product not found',
                    'data' => []
                ], 404);
            }

            //calculate total price
            if($request->quantity){
                $totalPrice = $request->quantity * $tempRequestedProduct->price;

                $tempRequestedProduct->update([
                    'quantity' => $request->quantity,
                    'total' => $totalPrice,
                ]);
            }
            
            if($request->spec) {
                $tempRequestedProduct->update([
                    'spec' => $request->spec ?? $tempRequestedProduct->spec ?? '',
                ]);
            }

            if($request->remarks) {
                $tempRequestedProduct->update([
                    'remarks' => $request->remarks ?? '',
                ]);
            }
            if($request->unit_type) {
                $tempRequestedProduct->update([
                    'unit_type' => $request->unit_type ?? '',
                ]);
            }

            if($request->unit_price) {
                $tempRequestedProduct->update([
                    'unit_price' => $request->unit_price ?? '',
                ]);
            }

            if($request->unit_package_size) {
                $tempRequestedProduct->update([
                    'unit_package_size' => $request->unit_package_size ?? '',
                ]);
            }
 
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
            $tempRequestedProduct = TempRequisitionProduct::find($id);

            if (!$tempRequestedProduct) {
                return response()->json([
                    'status' => false,
                    'message' => 'Temp requested product not found',
                    'data' => []
                ], 404);
            }

            $product = Product::find($tempRequestedProduct->product_id);

            $tempRequestedProduct->delete();

            if($product->is_active == 0){
                $product->delete();
            }
            

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
