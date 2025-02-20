<?php

namespace App\Http\Controllers;

use App\Models\LeisureAccept;
use App\Models\ModelHasRole;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ReceivedProduct;
use App\Models\RecievedInformation;
use App\Models\RecieveInformation;
use App\Models\Role;
use App\Models\TempReceivedProduct;

class ReceivedProductController extends Controller
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
        try {
            // generate requisition_no
            $receive_no = 'REC' . date('Ymd') . rand(1000, 9999);

            // create ReceivedInformation record
            $receivedInformation = RecievedInformation::create([
                'user_id' => auth()->user()->id,
                'recieve_date' => $request->billing_date,
                'receive_no' =>  $receive_no,
                'bill_no' => $request->billing_no,
                'purchase_from' => $request->purchase_from,
                // 'remarks' => $request->note,
                'status' => 0,
            ]);

            // check if the record is created
            if ($receivedInformation) {
                // get all temp requisition products based on user id
                $tempReceivedProducts = TempReceivedProduct::where('user_id', auth()->user()->id)->get();

                if ($tempReceivedProducts) {
                    foreach ($tempReceivedProducts as $tempReceivedProduct) {
                        // create ReceivedProduct records
                        ReceivedProduct::create([
                            'Received_id' => $receivedInformation->id,
                            'product_id' => $tempReceivedProduct->product_id,
                            'quantity' => $tempReceivedProduct->quantity,
                            'unit_price' => $tempReceivedProduct->unit_price,
                            'total_price' => $tempReceivedProduct->total_price
                        ]);
                    }

                    // delete all temp requisition products based on user id
                    TempReceivedProduct::where('user_id', auth()->user()->id)->delete();
                }

                // find the Super Admin user id
                $procurementAdmin = ModelHasRole::where('role_id', Role::where('name', 'Super Admin')->first()->id)->first();

                // new notification created for accept or reject the request of adding product
                Notification::create([
                    'title' => 'New Product Request',
                    'text' => 'New product request has been created by ' . auth()->user()->name . '. request no: ' . $receive_no . '. Please accept or reject the request.',
                    'from_user_id' => auth()->user()->id,
                    'to_user_id' => $procurementAdmin->model_id,
                    'link' => route('products.request.list')
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Requisition created successfully',
                    'data' => $receivedInformation,
                    'mydata' => $request->billing_no
                ], 201);
            }

            return response()->json([
                'status' => false,
                'message' => 'Failed to create requisition',
                'data' => []
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create requisition',
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
            $receivedProducts = ReceivedProduct::where('Received_id', $id)
            ->orderBy('id', 'DESC')
            ->with('product')
            ->get();

            $requisition = RecievedInformation::find($id);

            if ($receivedProducts->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Received products not found',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Received products fetched successfully',
                'data' => $receivedProducts,
                'requisition' => $requisition
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch received products',
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

    public function productApprove($id)
{
    try {
        // Retrieve all products for the received_id
        $products = ReceivedProduct::where('Received_id', $id)->get();

        // Retrieve the request information
        $requestinfo = RecievedInformation::findOrFail($id);
        $requestinfo->status = 1; // Mark the request as approved
        $requestinfo->save();

        // If no products are found, return a not found response
        if ($products->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No products found for this request',
                'data' => null
            ], 404);
        }

        foreach ($products as $product) {
            // Find the product in the Product table by product_id
            $receivedProductDetails = Product::where('id', $product->product_id)->first();

            // Update the final and temp quantities
            $receivedProductDetails->final_quantity += $product->quantity;
            $receivedProductDetails->temp_quantity += $product->quantity;
            $receivedProductDetails->is_active = 1;
            $receivedProductDetails->save();

            // Retrieve the related RecievedInformation
            $recievedInformation = RecievedInformation::findOrFail($product->Received_id);

            // Calculate amount for the leisure accept table
            $amount = $product->quantity * $receivedProductDetails->unit_price;

            $data = [
                'date' => $recievedInformation->recieve_date,
                'bill_no' => $recievedInformation->bill_no,
                'purchase_from' => $recievedInformation->purchase_from,
                'requisition_no' => $recievedInformation->receive_no,
                'details' => $receivedProductDetails->spec,
                'product_id' => $receivedProductDetails->id,
                'quantity' => $product->quantity,
                'unit' => $receivedProductDetails->unit_type_id,
                'price' => $receivedProductDetails->unit_price,
                'amount' => $amount,
                'discussion' => null,
                'status' => 1,
                'isActive' => 1,
                'store_id' => $recievedInformation->user_id
            ];

            LeisureAccept::create($data);
        }

        // Create a notification for the approved product
        Notification::create([
            'title' => 'Product Approved',
            'text' => 'Product has been approved by ' . auth()->user()->name . ' for ' . $recievedInformation->receive_no . ' .',
            'from_user_id' => auth()->user()->id,
            'to_user_id' => $recievedInformation->user_id,
            'link' => route('products.request.list')
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product approved successfully',
            'data' => $products // Return all approved products
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
            $product = RecievedInformation::findOrFail($id);

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                    'data' => null
                ], 404);
            }

            $product->status = 2;
            $product->save();

            // create notification for rejected product
            Notification::create([
                'title' => 'Product Rejected',
                'text' => 'Product has been rejected by ' . auth()->user()->name . ' for ' . $product->receive_no . ' .',
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $product->user_id,
                'link' => route('products.request.list')
            ]);

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
}
