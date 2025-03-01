<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Role;
use App\Models\TempRequisitionProduct;
use App\Models\UnitType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);

            

        if ($user->hasAnyRole('Super Admin', 'Accountant')) { 

            $order = Order::with( ['orderProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();

        } else {

            $order = Order::where( 'user_id', auth()->user()->id)

                ->with(['orderProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();

        }

        if ($user->hasAnyRole('Super Admin', 'Accountant')) { 

            $pendingOrder = Order::with( ['orderProducts.product', 'user'])

                ->where('status', 0)

                ->orderBy('id', 'DESC')

                ->get();

        } else {

            $pendingOrder = Order::where( 'user_id', auth()->user()->id)

                ->where('status', 0)

                ->with(['orderProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();

        }

        if ($user->hasAnyRole('Super Admin', 'Accountant')) { 

            $acceptOrder = Order::with( ['orderProducts.product', 'user'])

                ->where('status', 1)

                ->orderBy('id', 'DESC')

                ->get();

        } else {

            $acceptOrder = Order::where( 'user_id', auth()->user()->id)

                ->where('status', 1)

                ->with(['orderProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();

        }

        if ($user->hasAnyRole('Super Admin', 'Accountant')) { 

            $rejectOrder = Order::with( ['orderProducts.product', 'user'])

                ->where('status', 2)

                ->orderBy('id', 'DESC')

                ->get();

        } else {

            $rejectOrder = Order::where( 'user_id', auth()->user()->id)

                ->where('status', 2)

                ->with(['orderProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();

        }

        if ($user->hasAnyRole('Super Admin', 'Accountant')) { 

            $saveOrder = Order::with( ['orderProducts.product', 'user'])

                ->where('status', 11)

                ->orderBy('id', 'DESC')

                ->get();

        } else {

            $saveOrder = Order::where( 'user_id', auth()->user()->id)

                ->where('status', 11)

                ->with(['orderProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();

        }

        if ($user->hasAnyRole('Super Admin', 'Accountant')) { 

            $returnOrder = Order::with( ['orderProducts.product', 'user'])

                ->where('status', 12)

                ->orderBy('id', 'DESC')

                ->get();

        } else {

            $returnOrder = Order::where( 'user_id', auth()->user()->id)

                ->where('status', 12)

                ->with(['orderProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();

        }

        if ($user->hasAnyRole('Super Admin', 'Accountant')) { 

            $loanOrder = Order::with( ['orderProducts.product', 'user'])

                ->where('status', 14)

                ->orderBy('id', 'DESC')

                ->get();

        } else {

            $loanOrder = Order::where( 'user_id', auth()->user()->id)

                ->where('status', 14)

                ->with(['orderProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();

        }


        return view('backend.order.order', compact('order', 'pendingOrder', 'acceptOrder', 'rejectOrder', 'saveOrder', 'returnOrder', 'loanOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('is_active', 1)->with('productSubCategory', 'unitType')->get();

        $unitTypes = UnitType::all();

        return view('backend.order.createOrder', compact('products', 'unitTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {

            $this->validate($request, [
    
                'requisition_date' => 'required',
    
                'requisition_no' => 'required',
    
                'requisition_type' => 'required',
    
                'company_value' => 'required',
                
            ]);

            try {
    
                // Check if requisition_no exists
    
                if ($request->requisition_no) {
    
                    $existingRequisition = Order::where('order_no', $request->requisition_no)->first();
    
                    
    
                    if ($existingRequisition) {
    
                        return response()->json([
    
                            'errors' => [
    
                                'requisition_no' => 'Order number already exists. Please choose a different number.',
    
                            ]
    
                        ], 422); // Validation error code
    
                    }

                    //company find id
    
                    $company = Company::where('id', $request->company_value)->first();
    
    
    
                    $requisition = Order::create([
    
                        'user_id' => auth()->user()->id,
    
                        'order_date' => $request->requisition_date,
    
                        'order_no' => $request->requisition_no,
    
                        'order_type' => $request->requisition_type,
    
                        'company_id' => $request->company_value,

                        'buyer_name' => $company->name,

                        'address' => $company->address,
    
                        'status' => 0,
    
                        'cc'=> $request->category,
    
                        'auth' => $request->category_two,
    
                    ]);
    
                }else {
    
                    $counter = 500;
    
                    // Fetch the last order number
                    $lastOrder = Order::orderBy('id', 'DESC')->first();
            
                    if ($lastOrder) {
                        $lastCounter = intval($lastOrder->order_no);
                        $counter = $lastCounter + 1;
                    }
            
                    $order_no = (string) $counter;

                    //company find id

                    $company = Company::where('id', $request->company_value)->first();
    
                    $requisition = Order::create([
    
                        'user_id' => auth()->user()->id,
    
                        'order_date' => $request->requisition_date,
    
                        'order_no' => $order_no,
    
                        'order_type' => $request->requisition_type,
    
                        'company_id' => $request->company_value,

                        'buyer_name' => $company->name,

                        'address' => $company->address,
    
                        'status' => 0,
    
                        'cc'=> $request->category,
    
                        'auth' => $request->category_two,
    
                    ]);
    
                }
    
    
    
                //get all temp requisition products based on user id
    
                $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)
    
                ->where('is_active', 3)
    
                ->get();
    
    
    
                if ($tempRequestedProducts) {
    
                    foreach ($tempRequestedProducts as $tempRequestedProduct) {
    
                        OrderProduct::create([
    
                            'order_id' => $requisition->id,
    
                            'product_id' => $tempRequestedProduct->product_id,
    
                            'quantity' => $tempRequestedProduct->quantity,
    
                            'spec' => $tempRequestedProduct->spec,
    
                            'unit_type' => $tempRequestedProduct->unit_type,
    
                            'unit_price' => $tempRequestedProduct->unit_price,
    
                            'unit_package_size' => $tempRequestedProduct->unit_package_size,
    
                        ]);
    
                    }

                    //delete all temp requisition products based on user id
    
                    TempRequisitionProduct::where('user_id', auth()->user()->id)
    
                    ->where('is_active', 3)
    
                    ->delete();
    
                }
    
     
    
                if ($requisition) {
    
                    // Find the roles by name
    
                    $roles = Role::whereIn('name', ['Super Admin', 'Admin'])->get();
    
    
    
                    if ($roles->isEmpty()) {
    
                        return response()->json([
    
                            'status' => false,
    
                            'message' => 'Roles not found.',
    
                        ], 404);
    
                    }
    
    
    
                    // Get the authenticated user
    
                    $authUser = Auth::user();
    
    
    
                    // Retrieve all users with "Super Admin" or "Admin" role
    
                    $roleNames = $roles->pluck('name')->toArray();
    
                    $users = User::whereHas('roles', function ($query) use ($roleNames) {
    
                        $query->whereIn('name', $roleNames);
    
                    })->get();
    
    
    
                    // Create and send notifications to all "Super Admin" and "Admin" users
    
                    foreach ($users as $user) {
    
                        Notification::create([
    
                            'from_user_id' => $authUser->id,
    
                            'title' => 'New Requisition Created',
    
                            'text' => 'A new requisition has been created by ' . $authUser->name .  
    
                                    'Requisition No: ' . $requisition->requisition_no . ' Please check the requisition.',
    
                            'to_user_id' => $user->id,
    
                            'link' => route('requisitions.create')
    
                        ]);
    
                    }
    
    
    
    
    
                    //create new notification for the requisition
    
                    return response()->json([
    
                        'status' => true,
    
                        'message' => 'Requisition created successfully',
    
                        'data' => $requisition
    
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
    
    }

    public function orderAccept(string $id)
    {   

        try {
            $requisition = Order::find($id);
    
            if (!$requisition) {
    
                return response()->json([
    
                    'status' => false,
    
                    'message' => 'Requisition not found',
    
                ], 404);
    
            }

            $deleteTempProduct = TempRequisitionProduct::where('user_id', auth()->user()->id)
            ->get();

            foreach ($deleteTempProduct as $tempDeleteProduct) {

                $tempDeleteProduct->delete();

            }
            $orderProducts = OrderProduct::where('order_id', $id)->get();

            foreach ($orderProducts as $orderProduct) {
    
                TempRequisitionProduct::create([
    
                    'product_id' => $orderProduct->product_id,
    
                    'quantity' => $orderProduct->quantity,
    
                    'spec' => $orderProduct->spec,
    
                    'unit_type' => $orderProduct->unit_type,

                    'total' => $orderProduct->quantity * $orderProduct->unit_price,
    
                    'unit_price' => $orderProduct->unit_price,
    
                    'unit_package_size' => $orderProduct->unit_package_size,
    
                    'user_id' => auth()->user()->id,
    
                    'is_active' => 1,
    
                ]);
    
            }
    
            $requisition->status = 1;
    
            $requisition->save();
    
            return response()->json([
    
                'status' => true,
    
                'message' => 'Requisition accepted successfully',
    
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
    
                'status' => false,
    
                'message' => 'Failed to accept requisition',
    
                'error' => $e->getMessage()
    
            ], 500);
    
        }
    
    }
 
    //order reject function

    public function orderReject(string $id)
    {
        try {
            $requisition = Order::find($id);
    
            if (!$requisition) {
    
                return response()->json([
    
                    'status' => false,
    
                    'message' => 'Requisition not found',
    
                ], 404);
    
            }
    
            $requisition->status = 2;
    
            $requisition->save();
    
            return response()->json([
    
                'status' => true,
    
                'message' => 'Requisition rejected successfully',
    
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
    
                'status' => false,
    
                'message' => 'Failed to reject requisition',
    
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
            $requisition = Order::with(
                'user.order', 
                'orderProducts.product', 
                'orderProducts.unitType',
            )->find($id);
    
            return view('backend.order.orderShow', compact('requisition'));
    
        } catch (\Exception $e) {
            return view('backend.order.orderShow', compact('requisition'));
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

    public function orderGenerate()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access',
                    'data' => null
                ], 401);
            }
    
            $counter = 500;
    
            // Fetch the last order number
            $lastOrder = Order::orderBy('id', 'DESC')->first();
    
            if ($lastOrder) {
                $lastCounter = intval($lastOrder->order_no);
                $counter = $lastCounter + 1;
            }
    
            $order_no = (string) $counter;
    
            \Log::info("Generated Order Number: " . $order_no);
    
            return response()->json([
                'status' => true,
                'message' => 'Order number generated successfully',
                'data' => $order_no
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Order Generate Error: " . $e->getMessage()); // Log the error
    
            return response()->json([
                'status' => false,
                'message' => 'Failed to generate order number',
                'error' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function orderPrint(string $id)
    {
    
        try {
            $requisition = Order::with(
                'user.order', 
                'orderProducts.product', 
                'orderProducts.unitType',
            )->find($id);
    
            return view('backend.order.orderPrint', compact('requisition'));
    
        } catch (\Exception $e) {
            return view('backend.order.orderPrint', compact('requisition'));
        }
    }

    public function returnOrder(Request $request)

    {

        try {

            $order = Order::findOrFail($request->id);



            if (!$order) {

                return response()->json([

                    'status' => false,

                    'message' => 'order not found',

                    'data' => []

                ], 404);

            }



            $order->status = 12; 

            $order->remarks = $request->reason; 

            $order->save();



            //create new notification for the requisition

            Notification::create([

                'from_user_id' => auth()->user()->id,

                'title' => 'order Return',

                'text' => $order->order_no . ' has been returned by ' . auth()->user()->name . ' . Plese check it out.',

                'to_user_id' => $order->user_id,

                'link' => route('orders.index')

            ]);



            return response()->json([

                'status' => true,

                'message' => 'order send successfully',

                'data' => $order

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to send order',

                'error' => $e->getMessage()

            ], 500);

        }

    }

    public function TempOrderstore(Request $request)

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

                'is_active' => 3,

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

    public function editOrder($id)

    {

        try {

            $requisition = Order::with('company')->find($id);

            $requisitionProducts = OrderProduct::where('order_id', $id)
                ->get();

                $deleteTempProduct = TempRequisitionProduct::where('is_active', 3)
                ->where('user_id', auth()->user()->id)
                ->get();

                foreach ($deleteTempProduct as $tempDeleteProduct) {

                    $tempDeleteProduct->delete();

                }



                    foreach ($requisitionProducts as $tempRequestedProduct) {

                        TempRequisitionProduct::create([

                            'product_id' => $tempRequestedProduct->product_id,

                            'quantity' => $tempRequestedProduct->quantity,

                            'spec' => $tempRequestedProduct->spec,

                            'user_id'=> auth()->user()->id,

                            'remarks' => $tempRequestedProduct->remarks,

                            'unit_type'=> $tempRequestedProduct->unit_type,

                            'unit_price'=> $tempRequestedProduct->unit_price,

                            'unit_package_size'=> $tempRequestedProduct->unit_package_size,

                            'is_active'=> 3,

                        ]);

                    }



                    $products = Product::where('is_active', 1)

                    ->with('unitType')

                    ->orderBy('id', 'DESC')

                    ->get();

            

                    $unitTypes = UnitType::all();

                    $company = Company::all();

            

                    return view('backend.order.editOrder', compact('products', 'unitTypes','requisitionProducts','requisition','company'));



                } catch (\Exception $e) {

                    return view('backend.order.editOrder', compact('products', 'unitTypes','requisitionProducts','requisition','company'));

                }     

    }

    public function getTempOrder()

    {

        

        try {

            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

                ->where('is_active', 3)

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

    public function updateOrder(Request $request, $id)

    {
    
        try {
    
            // Check if the requisition exists
    
            $requisition = Order::find($id);
    
    
    
            if (!$requisition) {
    
                return response()->json([
    
                    'status' => false,
    
                    'message' => 'Requisition not found',
    
                    'data' => []
    
                ], 404);
    
            }
    
    
            //company find id

            $company = Company::where('id', $request->company_value)->first();
    
            // Update requisition
    
            $requisition->update([
    
                'user_id' => auth()->user()->id,
    
                'order_date' => $request->requisition_date,

                'order_no' => $request->requisition_no,

                'order_type' => $request->requisition_type,

                'company_id' => $request->company_value,

                'buyer_name' => $company->name,

                'address' => $company->address,

                'status' => 0,

                'cc'=> $request->category,

                'auth' => $request->category_two,
    
            ]);
    
    
    
            // Get all temp requisition products based on user id
    
            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)
    
            ->where('is_active',3)
    
            ->get();
    
    
    
            if ($tempRequestedProducts) {
    
                // First, delete old requisition products
    
                OrderProduct::where('order_id', $requisition->id)->delete();
    
    
    
                // Then, add new products
    
                foreach ($tempRequestedProducts as $tempRequestedProduct) {
    
                    OrderProduct::create([
    
                        'user_id' => auth()->user()->id,
    
                        'order_id' => $requisition->id,
    
                        'product_id' => $tempRequestedProduct->product_id,
    
                        'quantity' => $tempRequestedProduct->quantity,
    
                        'spec' => $tempRequestedProduct->spec,
    
                        'remarks' => $tempRequestedProduct->remarks,
    
                        'unit_type'=> $tempRequestedProduct->unit_type,
    
                        'unit_price'=> $tempRequestedProduct->unit_price,
    
                        'unit_package_size'=> $tempRequestedProduct->unit_package_size,
    
                        'is_active'=> 1,
    
                    ]);
    
                }
    
    
    
                // Get all temp requisition products based on user id and is_active status
    
                $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)
    
                    ->where('is_active', 3)
    
                    ->get();
    
    
    
                // Iterate through each product and delete it
    
                foreach ($tempRequestedProducts as $tempRequestedProduct) {
    
                    $tempRequestedProduct->delete();
    
                }
    
    
    
                //create new notification for the requisition
    
    
    
                Notification::create([
    
                    'from_user_id' => auth()->user()->id,  
    
                    'title' => 'Order Updated',
    
                    'text' => 'A Order has been updated by ' . auth()->user()->name . '. Order No: ' . $requisition->order_no . '. Please review and authorize it.',
    
                    'to_user_id' => auth()->user()->auth_by,
    
                    'link' => route('orders.index'),
    
                ]);
    
            }
    
    
    
            return response()->json([
    
                'status' => true,
    
                'message' => 'Requisition updated successfully',
    
                'data' => $requisition
    
            ], 200);
    
    
    
        } catch (\Exception $e) {
    
            return response()->json([
    
                'status' => false,
    
                'message' => 'Failed to update requisition',
    
                'error' => $e->getMessage()
    
            ], 500);
    
        }
    
    }

}
