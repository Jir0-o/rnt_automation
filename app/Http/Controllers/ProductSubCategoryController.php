<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $productSubCategories = ProductSubCategory::all();

            if($productSubCategories->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No product sub categories found',
                    'data' => []
                ], 404);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Product sub categories retrieved successfully',
                'data' => $productSubCategories
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve product sub categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subCategorys = ProductSubCategory::with('productCategory')
        ->get();

       return view('backend.products.createSubCategory', compact('subCategorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_name' => 'required|string|max:255',
                'product_category_id' => 'required|exists:product_categories,id',
            ]);
    
            $productSub = new ProductSubCategory();
            $productSub->product_sub_category_name = $validated['category_name'];
            $productSub->product_category_id = $validated['product_category_id'];
            $productSub->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Product Sub Category created successfully',
                'data' => $productSub
            ], 201); 
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create product Sub Category',
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
            $productSub = ProductSubCategory::find($id);
    
            if (!$productSub) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product sub category not found',
                    'data' => null
                ], 404);
            }
             
            return response()->json([
                'status' => true,
                'message' => 'Product Sub Category retrieved successfully',
                'product' => $productSub
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve product sub category',
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
            $productSubCategory = ProductSubCategory::find($id);

            if (!$productSubCategory) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product sub category not found',
                    'data' => null
                ], 404);
            }

            $validated = $request->validate([
                'category_name' => 'required|string|max:255',
                'product_category_id' => 'required|exists:product_categories,id',
            ]);

            $productSubCategory->product_sub_category_name = $validated['category_name'];
            $productSubCategory->product_category_id = $validated['product_category_id'];
            $productSubCategory->save();

            return response()->json([
                'status' => true,
                'message' => 'Product sub category updated successfully',
                'data' => $productSubCategory
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update product sub category',
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
            $productSub = ProductSubCategory::find($id);
    
            if (!$productSub) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sub Category not found',
                    'data' => null
                ], 404);
            }

            $products = Product::where('product_sub_categorie_id', $productSub->id)->get();
            
            // Delete each product
            foreach ($products as $product) {
                $product->delete();
            }
    
            $productSub->delete();
    
            return response()->json([
                'status' => true,
                'message' => 'Sub Category and associated products deleted successfully',
                'data' => null
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete Sub Category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
}
