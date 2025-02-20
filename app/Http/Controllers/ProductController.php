<?php



namespace App\Http\Controllers;



use App\Models\User;

use App\Models\Product;

use App\Models\UnitType;

use Illuminate\Http\Request;

use App\Models\LeisureAccept;

use App\Models\MissingRequisition;

use App\Models\ModelHasRole;

use App\Models\Notification;

use App\Models\ProductSubCategory;

use App\Models\ReceivedProduct;

use App\Models\RecievedInformation;

use App\Models\Role;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Carbon;



class ProductController extends Controller

{

    /**

     * Display a listing of the resource.

     */

    public function index()

    {

        try {

            $products = Product::where('is_active', 1)->get();



            if($products->isEmpty()) {

                return response()->json([

                    'status' => false,

                    'message' => 'No products found',

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

        $products = Product::where('is_active', 1)->orderBy('id', 'desc')->with('productSubCategory','unitType')

        ->get();



        $expiredProducts = Product::where('is_active', 3)->orderBy('id', 'desc')->with('productSubCategory','unitType')

        ->get();



        

        $startOfToday = Carbon::today();

        $authUser = Auth::user();



        $role = Role::where('name', 'Super Admin')->firstOrFail();

        $superAdminUsers = User::role($role->name)->get();

        

        foreach ($products as $product) {

            if ($product->is_active == 1 && Carbon::parse($product->expiry_date)->isBefore($startOfToday)) {

                $product->is_active = 3;

                $product->save();

        

                // Send notification to all Super Admin users

                foreach ($superAdminUsers as $superAdminUser) {

                    Notification::create([

                        'title' => "Product Expired",

                        'text' => "The product {$product->product_name} has expired.",

                        'from_user_id' => $authUser->id,

                        'to_user_id' => $superAdminUser->id,

                        'link' => route('products.create'),

                    ]);

                }

            }

        }

                

        foreach ($products as $product) {

            if ($product->is_active == 3 && Carbon::parse($product->expiry_date)->isAfter($startOfToday)) {

                $product->is_active = 1;

                $product->save();

            }



            if ($product->is_active == 3 && Carbon::parse($product->expiry_date)->isSameDay($startOfToday)) {

                $product->is_active = 1;

                $product->save();

            }

        }



       return view('backend.products.createProduct', compact('products', 'expiredProducts'));

    }



    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)

    {

        try {

            $validated = $request->validate([

                'product_name' => 'required|string|max:255',

                'product_category_id' => 'required|exists:product_categories,id',

                'product_sub_categorie_id' => 'required|exists:product_sub_categories,id',

                'unit_type_id' => 'required|exists:unit_types,id',

                'product_quantity' => 'required',

                'unit_price' => 'nullable',

                'product_specification' => 'nullable|string|max:255',

                // 'bill_no' => 'nullable|string|max:255',

                // 'purchase' => 'nullable|string|max:255',

                'date' => 'nullable|date',

                'manufacturing_date' => 'nullable|date',

                'expiry_date' => 'nullable|date',

                'unit_package_size' => 'nullable|string|max:255',

            ]);



            // find the Super Admin user id

            $procurementAdmin = ModelHasRole::where('role_id', Role::where('name', 'Super Admin')->first()->id)->first();



            // if( $procurementAdmin->model_id == auth()->id() ){

                $product = new Product();

                $product->product_name = $validated['product_name'];

                $product->product_categorie_id = $validated['product_category_id'];

                $product->product_sub_categorie_id = $validated['product_sub_categorie_id'];

                $product->unit_type_id = $validated['unit_type_id'];

                $product->final_quantity = $validated['product_quantity'];

                $product->temp_quantity = $validated['product_quantity'];

                $product->unit_price = $validated['unit_price'];

                $product->spec = $validated['product_specification'];

                // $product->purchase_from = $validated['purchase'];

                $product->purchase_date = $validated['date'];

                $product->manufacturing_date = $validated['manufacturing_date'];

                $product->expiry_date = $validated['expiry_date'];

                $product->unit_package_size = $validated['unit_package_size'];

                // $product->bar_code = $validated['bar_code'];

                $product->save();



                $leisureAccept = new LeisureAccept();

                $leisureAccept->date = $validated['date'];

                $leisureAccept->store_id = auth()->id();

                // $leisureAccept->requisition_no = null;

                // $leisureAccept->bill_no = $validated['bill_no'];

                // $leisureAccept->purchase_from = $validated['purchase'];

                $leisureAccept->details = $product->spec;

                $leisureAccept->product_id = $product->id;

                $leisureAccept->quantity = $validated['product_quantity'];

                $leisureAccept->manufacturing_date = $validated['manufacturing_date'];

                $leisureAccept->expiry_date = $validated['expiry_date'];

                $leisureAccept->unit = $validated['unit_type_id'];

                $leisureAccept->price = $validated['unit_price'];

                $leisureAccept->amount = $validated['product_quantity'] * $validated['unit_price'];

                $leisureAccept->discussion = "Directly Added";

                $leisureAccept->status = 1;

                $leisureAccept->isActive = 1;

                $leisureAccept->save();



                // find the Super Admin user id

                $procurementAdminId = ModelHasRole::where('role_id', Role::where('name', 'Super Admin')->first()->id)->first();



                // new notification created for adding product

                Notification::create([

                    'title' => 'New Product Created',

                    'text' => 'New product has been created by ' . auth()->user()->name . '.',

                    'from_user_id' => auth()->user()->id,

                    'to_user_id' => $procurementAdminId->model_id,

                    'link' => route('products.create')

                ]);



                return response()->json([

                    'status' => true,

                    'message' => 'Product created successfully',

                    'data' => $product

                ], 201); // 201 Created status code for successful creation

            // }



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to create product',

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

            $product = Product::find($id);



            if (!$product) {

                return response()->json([

                    'status' => false,

                    'message' => 'Product not found',

                    'data' => null

                ], 404);

            }



            return response()->json([

                'status' => true,

                'message' => 'Product retrieved successfully',

                'product' => $product

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to retrieve product',

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

            $product = Product::findOrFail($id);



            if (!$product) {

                return response()->json([

                    'status' => false,

                    'message' => 'product not found',

                    'data' => null

                ], 404);

            }

            $validated = $request->validate([

                    'product_name' => 'required|string|max:255',

                    'product_category_id' => 'required|exists:product_categories,id',

                    'product_sub_categorie_id' => 'required|exists:product_sub_categories,id',

                    'unit_type_id' => 'required|exists:unit_types,id',

                    'product_quantity' => 'required',

                    'unit_price' => 'nullable',

                    'product_specification' => 'nullable|string|max:255',

                    'edit-date' => 'nullable|date',

                    'edit-manufacturing-date' => 'nullable|date',

                    'edit-expiry-date' => 'nullable|date',

                    'edit-unit-package-size' => 'nullable|string|max:255',



            ]);



                $product->product_name = $validated['product_name'];

                $product->product_categorie_id = $validated['product_category_id'];

                $product->product_sub_categorie_id = $validated['product_sub_categorie_id'];

                $product->unit_type_id = $validated['unit_type_id'];

                $product->final_quantity = $validated['product_quantity'];

                $product->temp_quantity = $validated['product_quantity'];

                $product->unit_price = $validated['unit_price'];

                $product->spec = $validated['product_specification'];

                $product->purchase_date = $validated['edit-date'];

                $product->manufacturing_date = $validated['edit-manufacturing-date'];

                $product->expiry_date = $validated['edit-expiry-date'];

                $product->unit_package_size = $validated['edit-unit-package-size'];

                // $product->requisition_no = $validated['edit-requisition-no'];

                // $product->bar_code = $validated['bar_code'];

                $product->save();



            return response()->json([

                'status' => true,

                'message' => 'Product updated successfully',

                'data' => $product

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

            $product = Product::find($id);



            // // find received product

            // $receivedProduct = ReceivedProduct::where('product_id', $id)->first();



            // if($receivedProduct != null) {

            //     // find received information

            //     $receivedInformation = RecievedInformation::where('id', $receivedProduct->Received_id)->first();



            //     if($receivedInformation != null) {

            //         // delete received product

            //         $receivedProduct->delete();

            //         // delete received information

            //         $receivedInformation->delete();

            //     }

            // }



            if (!$product) {

                return response()->json([

                    'status' => false,

                    'message' => 'Product not found',

                    'data' => null

                ], 404);

            }



            $product->is_active = 0;

            $product->save();



            return response()->json([

                'status' => true,

                'message' => 'Product deleted successfully',

                'data' => null

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to delete product',

                'error' => $e->getMessage()

            ], 500);

        }

    }





    public function getProductswithrequestQuantityNotNull()

    {

        $user = User::find(Auth::user()->id);



        if($user->hasRole('Super Admin')){

            $products = RecievedInformation::with('user')->get();

        } else {

            $products = RecievedInformation::where('user_id', Auth::user()->id)->get();

        }



        return view('backend.purchases.requested_products', compact('products'));

    }



    public function productApprove($id)



    {

        try {

            $product = Product::findOrFail($id);



            if (!$product) {

                return response()->json([

                    'status' => false,

                    'message' => 'Product not found',

                    'data' => null

                ], 404);

            }



            $product->final_quantity = $product->request_quantity;

            $product->temp_quantity = $product->request_quantity;

            $product->request_quantity = null;

            $product->is_active = 1;

            $product->save();



            return response()->json([

                'status' => true,

                'message' => 'Product approved successfully',

                'data' => $product

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to approve product',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function productReject($id)

    {

        try {

            $product = Product::findOrFail($id);



            if (!$product) {

                return response()->json([

                    'status' => false,

                    'message' => 'Product not found',

                    'data' => null

                ], 404);

            }



            $product->request_quantity = null;

            $product->save();



            return response()->json([

                'status' => true,

                'message' => 'Product rejected successfully',

                'data' => $product

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to reject product',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function createBarcode($id)

    {

        $id = decrypt($id);



        $Product = Product::where('id', '=', $id)->first();



        if ($Product->bar_code == null) {

            $Product->bar_code = sprintf("%04d", $Product->id);

            $Product->update();



            return response()->json([

                'status' => true,

                'message' => 'Barcode Generated successfully',

            ], 200);

        }else{

            return response()->json([

                'exist' => true,

                'message' => 'Already Have a Barcode',

            ], 409);

        }

    }



    public function printBarcode($id)

    {

        $id = decrypt($id);

        $Product = Product::where('id', '=', $id)->first();

        $barcode = $Product->bar_code;

        if ($Product->bar_code == null) {

            return redirect()->back()->with('fail', 'Barcode is Not Generated Yet');

        }



        return view('print.printBarcode', compact([ 'barcode', 'Product']));

    }



    public function productsMissing(Request $request)

    {

        try {

            $validated = $request->validate([

                'product_name' => 'required|string|max:255|unique:products,product_name',

                'product_category_id' => 'required|exists:product_categories,id',

                'product_sub_categorie_id' => 'required|exists:product_sub_categories,id',

                'unit_type_id' => 'required|exists:unit_types,id',

                'bar_code' => 'nullable|string|max:255',

                'product_quantity' => 'required',

                // 'unit_price' => 'required',

                'product_specification' => 'nullable|string|max:255',

                'bill_no' => 'nullable|string|max:255',

                'purchase' => 'nullable|string|max:255',

                'date' => 'nullable|date',

            ]);

            $product = new Product();

            $product->product_name = $validated['product_name'];

            $product->product_categorie_id = $validated['product_category_id'];

            $product->product_sub_categorie_id = $validated['product_sub_categorie_id'];

            $product->unit_type_id = $validated['unit_type_id'];

            $product->final_quantity = $validated['product_quantity'];

            $product->temp_quantity = $validated['product_quantity'];

            $product->unit_price = $validated['unit_price'];

            $product->spec = $validated['product_specification'];

            $product->bill_no = null;

            $product->purchase_from = null;

            $product->purchase_date = null;

            // $product->bar_code = $validated['bar_code'];

            $product->save();



            return response()->json([

                'status' => true,

                'message' => 'Product created successfully',

                'data' => $product

            ], 201); // 201 Created status code for successful creation



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Product already Added',

                'error' => $e->getMessage()

            ], 500);

        }

    }



}

