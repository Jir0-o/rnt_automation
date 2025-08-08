<?php



namespace App\Http\Controllers;



use App\Models\Product;

use App\Models\ProductCategory;

use App\Models\ProductSubCategory;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator as FacadesValidator;

use Validator;



class ProductCategoryController extends Controller

{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('permission:Can Access Category')->only(['index', 'create', 'store', 'edit', 'update', 'destroy', 'getSubCategories', 'getProducts']);
    }

    /**

     * Display a listing of the resource.

     */

    public function index()

    {

        try {

            $productCategories = ProductCategory::all();



            if($productCategories->isEmpty()) {

                return response()->json([

                    'status' => false,

                    'message' => 'No product categories found',

                    'data' => []

                ], 404);

            }



            return response()->json([

                'status' => true,

                'message' => 'Product categories retrieved successfully',

                'data' => $productCategories

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to retrieve product categories',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function getSubCategories(string $id)

    {

        try {

            $subCategories = ProductSubCategory::where('product_category_id', $id)->get();



            if(!$subCategories) {

                return response()->json([

                    'status' => false,

                    'message' => 'No sub-categories found for this product category',

                    'data' => []

                ], 404);

            }



            return response()->json([

                'status' => true,

                'message' => 'Sub-categories retrieved successfully',

                'data' => $subCategories

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to retrieve sub-categories',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function getProducts(string $id)

    {

        try {

            $products = Product::where('product_sub_categorie_id', $id)

            ->with('unitType')

            ->get();



            if(!$products) {

                return response()->json([

                    'status' => false,

                    'message' => 'No products found for this sub-category',

                    'data' => []

                ], 404);

            }



            return response()->json([

                'status' => true,

                'message' => 'Products retrieved successfully',

                'data' => $products

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to retrieve products',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    /**

     * Show the form for creating a new resource.

     */

    public function create()

    {

        $categorys = ProductCategory::all();



       return view('backend.products.createCategory', compact('categorys'));

    }



    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)

    {

        try {

            $validated = $request->validate([

            'category_name' => 'required|string|max:255',

            ]);





            $category = new ProductCategory();

            $category->product_category_name = $validated['category_name'];

            $category->save();



            



            return response()->json([

                'status' => true,

                'message' => 'Category Create successfully',

                'data' => $category

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

    public function show($id)

    {

        try {

            $category = ProductCategory::find($id);



            if (!$category) {

                return response()->json([

                    'status' => false,

                    'message' => 'Category not found',

                    'data' => null

                ], 404);

            }



            return response()->json([

                'status' => true,

                'message' => 'Category retrieved successfully',

                'data' => $category

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to retrieve category',

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

    public function update(Request $request, $id)

    {

        try {

            $category = ProductCategory::find($id);



            if (!$category) {

                return response()->json([

                    'status' => false,

                    'message' => 'Category not found',

                    'data' => null

                ], 404);

            }



            // Validate the request data

            $validated = $request->validate([

                'product_category_name' => 'required|string|max:255',

            ]);



            // Update the category

            $category->product_category_name = $validated['product_category_name'];

            $category->save();



            return response()->json([

                'status' => true,

                'message' => 'Category updated successfully',

                'data' => $category

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to update category',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    /**

     * Remove the specified resource from storage.

     */

    public function destroy($id)

    {

        try {

            $category = ProductCategory::find($id);



            if (!$category) {

                return response()->json([

                    'status' => false,

                    'message' => 'Category not found',

                    'data' => null

                ], 404);

            }



            $subCategories = ProductSubCategory::where('product_category_id', $id)->get();

            foreach ($subCategories as $subCategory) {

                $products = Product::where('product_sub_categorie_id', $subCategory->id)->get();

                foreach ($products as $product) {

                    $product->delete();

                }

                $subCategory->delete();

            }



            $category->delete();



            return response()->json([

                'status' => true,

                'message' => 'Category deleted successfully',

                'data' => null

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to delete category',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function catagory(){

        try {

            $productSubCategories = ProductCategory::all();



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



    public function getByCategory($categoryId)

{

    try {

        $productSubCategories = ProductSubCategory::where('product_category_id', $categoryId)->get();



        if ($productSubCategories->isEmpty()) {

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



}

