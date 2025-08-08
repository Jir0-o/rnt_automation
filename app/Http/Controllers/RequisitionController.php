<?php



namespace App\Http\Controllers;



use App\Models\Company;

use App\Models\Department;

use App\Models\Designation;

use App\Models\MissingRequisition;

use App\Models\ModelHasRole;

use App\Models\Notification;

use App\Models\Product;

use App\Models\Requisition;

use App\Models\RequisitionProduct;

use App\Models\RequisitionSignature;

use App\Models\Role;

use App\Models\TempRequisitionProduct;

use App\Models\UnitType;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;



class RequisitionController extends Controller

{  
    /**
     * Create a new controller instance.
     */
    public function __construct()

    {
        $this->middleware('permission:Can Access Requisitions')->only(['index', 'create', 'store', 'edit', 'update', 'destroy', 'rejectRequisition', 'acceptRequisition', 'acceptAuthRequisition', 'loanRequisition', 'noRequisition', 'editNoRequisition', 'createRequisition']);
    }

    /**

     * Display a listing of the resource.

     */

    public function index()

    {

        try {

            $user = User::find(Auth::user()->id);

            

            if($user->hasRole('Super Admin')){

                $requisitions = Requisition::where('status', 1)->with( ['requisitionProducts.product', 'user'])

                    ->orderBy('id', 'DESC')

                    ->get();

            } else {

                $requisitions = Requisition::where( 'user_id', auth()->user()->id)->where('status', 1)

                    ->with(['requisitionProducts.product', 'user'])

                    ->orderBy('id', 'DESC')

                    ->get();

            }



            if (!$requisitions) {

                return response()->json([

                    'status' => false,

                    'message' => 'No data found',

                    'data' => []

                ], 404);

            }



            return response()->json([

                'status' => true,

                'message' => 'Requisitions fetched successfully',

                'data' => $requisitions

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to fetch requisitions',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    /**

     * Show the form for creating a new resource.

     */

    public function create()

    {

        $user = User::find(Auth::user()->id);



        if($user->hasRole('Super Admin')){



            $UserId = User::where('auth_by', $user->id)->pluck('id')->toArray();



            $authRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->whereIn('user_id', $UserId)

                ->where('status', '=', 0)

                ->orderBy('id', 'DESC')

                ->get();



            $saveRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->where('user_id', auth()->user()->id)

                ->where('status', '=', 11)

                ->orderBy('id', 'DESC')

                ->get();

        

            $returnRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->where('user_id', auth()->user()->id)

                ->whereIn('status', [12, 13]) 

                ->orderBy('id', 'DESC')

                ->get();



            $rejectedRequisitions = Requisition::with( ['requisitionProducts.product', 'user'])

                ->where('status', '=', 2)

                ->orderBy('id', 'DESC')

                ->get();

            

            $AcceptedRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->where('status', '=', 1) 

                ->orderBy('id', 'DESC')

                ->get();



            $LoanRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->where('status', '=', 14) 

                ->orderBy('id', 'DESC')

                ->get();



            $requisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();



            $newRequisitionsCount = Requisition::whereIn('user_id', $UserId)

                ->where('is_active', 1)

                ->count();



            // Mark all requisitions as viewed for the user

            // Requisition::whereIn('user_id', $UserId)

            //     ->where('is_active', 1)

            //     ->update(['is_active' => 0]);

        } else {

            $UserId = User::where('auth_by', $user->id)->pluck('id')->toArray();



            $authRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->whereIn('user_id', $UserId)

                ->where('status', '=', 0)

                ->orderBy('id', 'DESC')

                ->get();

            

            $saveRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->where('user_id', auth()->user()->id)

                ->where('status', '=', 11)

                ->orderBy('id', 'DESC')

                ->get();



            $returnRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->where('user_id', auth()->user()->id)

                ->whereIn('status', [12, 13]) 

                ->orderBy('id', 'DESC')

                ->get();

            

            $rejectedRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->where('user_id', auth()->user()->id)

                ->where('status', '=', 2)

                ->orderBy('id', 'DESC')

                ->get();

            

            $AcceptedRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->where('user_id', auth()->user()->id)

                ->where('status', '=', 1)

                ->orderBy('id', 'DESC')

                ->get();



            $LoanRequisitions = Requisition::with(['requisitionProducts.product', 'user'])

                ->where('status', '=', 14) 

                ->orderBy('id', 'DESC')

                ->get();



            $requisitions = Requisition::where('user_id', auth()->user()->id)

                ->with(['requisitionProducts.product', 'user'])

                ->orderBy('id', 'DESC')

                ->get();



            // Mark all requisitions as viewed for the user

            // Requisition::where('is_active', 1)

            //     ->update(['is_active' => 0]);

        }



        return view('backend.requisitions.requisitions', compact('requisitions', 'authRequisitions', 'rejectedRequisitions', 'AcceptedRequisitions','saveRequisitions','returnRequisitions','LoanRequisitions'));

    }



    public function createRequisition()

    {

        $products = Product::where('is_active', 1)

        ->with('unitType')

        ->orderBy('id', 'DESC')

        ->get();



        $unitTypes = UnitType::all();



        return view('backend.requisitions.requisitions_add', compact('products', 'unitTypes'));

    }



    public function rejectRequisition($id)

    {

        try {

            $requisition = Requisition::find($id);



            if (!$requisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition not found',

                    'data' => []

                ], 404);

            }



            $requisition->status = 2;

            $requisition->save();



            return response()->json([

                'status' => true,

                'message' => 'Requisition rejected successfully',

                'data' => $requisition

            ], 200);



            //create new notification for the requisition rejector

            Notification::create([

                'from_user_id' => auth()->user()->id,

                'title' => 'Requisition Rejected',

                'text' => 'Your requisition has been rejected by ' . auth()->user()->name . '. for ' . $requisition->requisition_no . '.',

                'to_user_id' => $requisition->user_id,

                // base url for the link to the requisition

                'link' => route('requisitions.create')

            ]);





        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to reject requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function acceptRequisition($id)

    {

        try {

            $requisition = Requisition::find($id);



            if (!$requisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition not found',

                    'data' => []

                ], 404);

            }



            $requisition->status = 3;

            $requisition->save();



            return response()->json([

                'status' => true,

                'message' => 'Requisition accepted successfully',

                'data' => $requisition

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to accept requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function acceptAuthRequisition($id)

    {

        try {

            $requisition = Requisition::find($id);



            if (!$requisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition not found',

                    'data' => []

                ], 404);

            }



            // Determine status before creating the requisition

            $status = ($requisition->requisition_type == 2) ? 14 : 1;



            $requisition->status = $status;

            $requisition->save();



            

            $allocatedQuantity = RequisitionProduct::where('requisition_id', $requisition->id)->get();



            foreach ($allocatedQuantity as $quantity) {

                $product = Product::where('id', $quantity->product_id)->first();

                $product->allocation_quantity = $product->allocation_quantity + $quantity->quantity;

                $product->final_quantity = $product->final_quantity - $quantity->quantity;

                $product->temp_quantity = $product->temp_quantity - $quantity->quantity;

                $product->save();

            }



            $designation = Designation::where('id', auth()->user()->designation_id)->first();



            $department = Department::where('id', auth()->user()->department_id)->first();



            RequisitionSignature::create([

                'requisition_id' => $requisition->id,

                'signature' => auth()->user()->signature,

                'date' => $requisition->requisition_date,

                'name' => auth()->user()->name,

                'designation' => $designation->designation,

                'department' => $department->name,

                'status' => 1,

            ]);



            //create new notification for the requisition authorizer

            Notification::create([

                'from_user_id' => auth()->user()->id,

                'title' => 'Requisition Authorized',

                'text' => 'Your requisition has been authorized by ' . auth()->user()->name . '. for ' . $requisition->requisition_no . '.',

                'to_user_id' => $requisition->user_id,

                // base url for the link to the requisition

                'link' => route('requisitions.create')

            ]);



            // create new notification for the Super Admin to review the requisition

            $user_id = ModelHasRole::where('role_id', 2)->first();



            Notification::create([

                'from_user_id' => auth()->user()->id,

                'title' => 'Requisition Authorized',

                'text' => 'A requisition has been authorized by ' . auth()->user()->name . '. Requisition No: ' . $requisition->requisition_no . '. Please review and allocate it.',

                'to_user_id' => $user_id->model_id,

                'link' => route('requisitions.create')

            ]);



            return response()->json([

                'status' => true,

                'message' => 'Requisition accepted successfully',

                'data' => $requisition

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to accept requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function loanRequisition($id)

    {

        try {

            $requisition = Requisition::find($id);



            if (!$requisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition not found',

                    'data' => []

                ], 404);

            }





            $requisition->status = 15;

            $requisition->save();



            

            $allocatedQuantity = RequisitionProduct::where('requisition_id', $requisition->id)->get();



            foreach ($allocatedQuantity as $quantity) {

                $product = Product::where('id', $quantity->product_id)->first();

                $product->allocation_quantity = $product->allocation_quantity - $quantity->quantity;

                $product->final_quantity = $product->final_quantity + $quantity->quantity;

                $product->temp_quantity = $product->temp_quantity + $quantity->quantity;

                $product->save();

            }



            // $designation = Designation::where('id', auth()->user()->designation_id)->first();



            // $department = Department::where('id', auth()->user()->department_id)->first();



            // RequisitionSignature::create([

            //     'requisition_id' => $requisition->id,

            //     'signature' => auth()->user()->signature,

            //     'date' => $requisition->requisition_date,

            //     'name' => auth()->user()->name,

            //     'designation' => $designation->designation,

            //     'department' => $department->name,

            //     'status' => 1,

            // ]);



            if ($requisition) {

                //create new notification for the requisition

                Notification::create([

                    'from_user_id' => auth()->user()->id,

                    'title' => 'Loan Product has been returned',

                    'text' => 'A loan product has been returned by ' . auth()->user()->name . '. Requisition No: ' . $requisition->requisition_no,

                    'to_user_id' => auth()->user()->auth_by,

                    'link' => route('requisitions.create')

                ]);

            }



            return response()->json([

                'status' => true,

                'message' => 'Requisition accepted successfully',

                'data' => $requisition

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to accept requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    // public function convertToBanglaNumerals($number) {

    //     $englishToBanglaDigits = [

    //         '0' => '০',

    //         '1' => '১',

    //         '2' => '২',

    //         '3' => '৩',

    //         '4' => '৪',

    //         '5' => '৫',

    //         '6' => '৬',

    //         '7' => '৭',

    //         '8' => '৮',

    //         '9' => '৯'

    //     ];

    

    //     return strtr($number, $englishToBanglaDigits);

    // }



    // public function convertToEnglishNumerals($number)

    // {

    //     $banglaToEnglishDigits = [

    //         '০' => '0',

    //         '১' => '1',

    //         '২' => '2',

    //         '৩' => '3',

    //         '৪' => '4',

    //         '৫' => '5',

    //         '৬' => '6',

    //         '৭' => '7',

    //         '৮' => '8',

    //         '৯' => '9'

    //     ];



    //     return strtr($number, $banglaToEnglishDigits);

    // }



    public function noRequisition(Request $request){



        try {

            // if ($request->requisition_no) {

            //     $existingRequisition = Requisition::where('requisition_no', $request->requisition_no)->first();

                

            //     if ($existingRequisition) {

            //         return response()->json([

            //             'errors' => [

            //                 'requisition_no' => 'স্মারক নং ইতিমধ্যে বিদ্যমান',

            //             ]

            //         ], 422); // Validation error code

            //     }



            //     $requisition = Requisition::create([

            //         'user_id' => auth()->user()->id,

            //         'requisition_date' => $request->requisition_date,

            //         'requisition_no' => $request->requisition_no,

            //         'remarks' => $request->note ?? $request->remarks ?? '', // Use the note field if remarks field is not available

            //         'status' => 0,

            //         'cc'=> $request->category,

            //         'auth' => $request->category_two,

            //     ]);



            //     //create missing requisition products

            //     $missingRequisitions = new MissingRequisition();

            //     $missingRequisitions->product_name = $request->product_name;

            //     $missingRequisitions->quantity = $request->quantity;

            //     $missingRequisitions->spec = $request->spec;

            //     $missingRequisitions->note = $request->note;

            //     $missingRequisitions->unit_type = $request->unit_type;

            //     $missingRequisitions->requisition_id = $requisition->id;

            //     $missingRequisitions->save();



            //     // dynamic missing requisition

            //     if ($request->dynamicValues) {

            //         foreach ($request->dynamicValues as $dynamicValue) {

            //             $missingRequisitions = new MissingRequisition();

            //             $missingRequisitions->product_name = $dynamicValue['product_name'];

            //             $missingRequisitions->quantity = $dynamicValue['quantity'];

            //             $missingRequisitions->spec = $dynamicValue['spec'];

            //             $missingRequisitions->note = $dynamicValue['note'];

            //             $missingRequisitions->unit_type = $dynamicValue['unit_type'];

            //             $missingRequisitions->requisition_id = $requisition->id;

            //             $missingRequisitions->save();

            //         }

            //     }



            //     // signature

            //     RequisitionSignature::create([

            //         'requisition_id' => $requisition->id,

            //         'signature' => auth()->user()->signature,

            //         'date' => date('Y-m-d'),

            //         'status' => 1,

            //     ]);

            // }

            // else {

                

            //     $userDepartment = Auth::user()->department_id;



            //     // find the Department name

            //     $department = Department::find($userDepartment);

    

            //     // Define the prefixes and other components

            //     $prefix1 = 'শেহামেবি';

            //     $prefix2 = $department->name;

    

            //     // Get the current fiscal year (e.g., ২০২৪-২০২৫)

            //     $currentYear = date('Y');

            //     $nextYear = $currentYear + 1;

            //     $fiscalYear = $currentYear . '-' . $nextYear;

    

            //     // Convert the fiscal year to Bangla

            //     $banglaFiscalYear = $this->convertToBanglaNumerals($fiscalYear);



            //     // Example counter

            //     $counter = 4000; // This is the counter that should be in Bangla

    

            //     // find the last requisition number and get the counter value from it and increment it by 1

            //     $lastRequisition = Requisition::where('requisition_no', 'like', '%' . $prefix1 . '/' . $prefix2 . '/' . $banglaFiscalYear . '/%')

            //         ->orderBy('id', 'DESC')

            //         ->first();



            //     if ($lastRequisition) {

            //         $lastRequisitionNo = $lastRequisition->requisition_no;

            //         $lastRequisitionNoParts = explode('/', $lastRequisitionNo);

                

            //         // Convert the Bangla counter back to English numerals for arithmetic operations

            //         $lastCounter = $this->convertToEnglishNumerals($lastRequisitionNoParts[3]);

                

            //         // Increment the counter

            //         $counter = (int)$lastCounter + 1;

            //     }

                

            //     // Convert the counter to Bangla

            //     $banglaCounter = $this->convertToBanglaNumerals($counter);

                

            //     // Combine all parts to form the requisition number

            //     $requisition_no = $prefix1 . '/' . $prefix2 . '/' . $banglaFiscalYear . '/' . $banglaCounter;

    

            //     $requisition = Requisition::create([

            //         'user_id' => auth()->user()->id,

            //         'requisition_date' => $request->requisition_date,

            //         'requisition_no' => $requisition_no,

            //         'remarks' => $request->note ?? $request->remarks ?? '', // Use the note field if remarks field is not available

            //         'status' => 0,

            //         'cc'=> $request->category,

            //         'auth' => $request->category_two,

            //     ]);



            //     //create missing requisition products

            //     $missingRequisitions = new MissingRequisition();

            //     $missingRequisitions->product_name = $request->product_name;

            //     $missingRequisitions->quantity = $request->quantity;

            //     $missingRequisitions->spec = $request->spec;

            //     $missingRequisitions->note = $request->note;

            //     $missingRequisitions->unit_type = $request->unit_type;

            //     $missingRequisitions->requisition_id = $requisition->id;

            //     $missingRequisitions->save();



            //     // dynamic missing requisition

            //     if ($request->dynamicValues) {

            //         foreach ($request->dynamicValues as $dynamicValue) {

            //             $missingRequisitions = new MissingRequisition();

            //             $missingRequisitions->product_name = $dynamicValue['product_name'];

            //             $missingRequisitions->quantity = $dynamicValue['quantity'];

            //             $missingRequisitions->spec = $dynamicValue['spec'];

            //             $missingRequisitions->note = $dynamicValue['note'];

            //             $missingRequisitions->unit_type = $dynamicValue['unit_type'];

            //             $missingRequisitions->requisition_id = $requisition->id;

            //             $missingRequisitions->save();

            //         }

            //     }



            //     // signature

            //     RequisitionSignature::create([

            //         'requisition_id' => $requisition->id,

            //         'signature' => auth()->user()->signature,

            //         'date' => date('Y-m-d'),

            //         'status' => 1,

            //     ]);

            // }



            // if ($requisition) {

            //     //create new notification for the requisition

            //     Notification::create([

            //         'from_user_id' => auth()->user()->id,

            //         'title' => 'New Requisition Created',

            //         'text' => 'A new requisition has been created by ' . auth()->user()->name . '. Requisition No: ' . $requisition->requisition_no . '. Please review and authorize it.',

            //         'to_user_id' => auth()->user()->auth_by,

            //         'link' => route('requisitions.create')

            //     ]);



            //     //create new notification for the requisition

            //     return response()->json([

            //         'status' => true,

            //         'message' => 'Requisition created successfully',

            //         'data' => $requisition

            //     ], 201);

            // }



            $products = new Product();



            $products->product_name = $request->product_name;

            $products->spec = $request->spec;

            $products->unit_type_id  = $request->unit_type;

            $products->total_price = 0;

            $products->unit_price = 0;

            $products->temp_quantity = 0;

            $products->final_quantity = 0;

            $products->is_active = 0;

            $products->save();



            //create temp requisition products

            $tempRequisitionProducts = new TempRequisitionProduct();

            $tempRequisitionProducts->product_id = $products->id;

            $tempRequisitionProducts->quantity = $request->quantity;

            $tempRequisitionProducts->spec = $request->spec;

            $tempRequisitionProducts->remarks = $request->note;

            $tempRequisitionProducts->unit_type = $request->unit_type;

            $tempRequisitionProducts->user_id = auth()->user()->id;

            $tempRequisitionProducts->save();



            return response()->json([

                'status' => true,

                'message' => 'product added successfully',

                'data' => $products

            ], 201);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to create requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }

    public function editNoRequisition(Request $request){



        try {

            $products = new Product();



            $products->product_name = $request->product_name;

            $products->spec = $request->spec;

            $products->unit_type_id  = $request->unit_type;

            $products->total_price = 0;

            $products->unit_price = 0;

            $products->temp_quantity = 0;

            $products->final_quantity = 0;

            $products->is_active = 0;

            $products->save();



            //create temp requisition products

            $tempRequisitionProducts = new TempRequisitionProduct();

            $tempRequisitionProducts->product_id = $products->id;

            $tempRequisitionProducts->quantity = $request->quantity;

            $tempRequisitionProducts->spec = $request->spec;

            $tempRequisitionProducts->remarks = $request->note;

            $tempRequisitionProducts->unit_type = $request->unit_type;

            $tempRequisitionProducts->user_id = auth()->user()->id;

            $tempRequisitionProducts->is_active = 2;

            $tempRequisitionProducts->save();



            return response()->json([

                'status' => true,

                'message' => 'product added successfully',

                'data' => $products

            ], 201);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to create requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)

    {

        try {

            // Check if requisition_no exists

            if ($request->requisition_no) {

                $existingRequisition = Requisition::where('requisition_no', $request->requisition_no)->first();

                

                if ($existingRequisition) {

                    return response()->json([

                        'errors' => [

                            'requisition_no' => 'স্মারক নং ইতিমধ্যে বিদ্যমান',

                        ]

                    ], 422); // Validation error code

                }



                $requisition = Requisition::create([

                    'user_id' => auth()->user()->id,

                    'requisition_date' => $request->requisition_date,

                    'requisition_no' => $request->requisition_no,

                    'remarks' => $request->note ?? $request->remarks ?? '', // Use the note field if remarks field is not available

                    'buyer_name' => $request->buyer_name, 

                    'address' => $request->address, 

                    'sr_no' => $request->sr,

                    'requisition_type' => $request->requisition_type,

                    'company_id' => $request->company_value,

                    'status' => 0,

                    'cc'=> $request->category,

                    'auth' => $request->category_two,

                ]);

            }else {

                $prefix1 = 'Challan';

    

                // Find last requisition number and increment the counter

                $lastRequisition = Requisition::where('requisition_no', 'like', $prefix1 . '/%')

                    ->orderBy('id', 'DESC')

                    ->first();

    

                $counter = 4000; // Default counter

                if ($lastRequisition) {

                    $lastRequisitionNoParts = explode('/', $lastRequisition->requisition_no);

                    if (isset($lastRequisitionNoParts[1]) && is_numeric($lastRequisitionNoParts[1])) {

                        $counter = (int)$lastRequisitionNoParts[1] + 1;

                    }

                }

            

                

                // Combine all parts to form the requisition number

                $requisition_no = $prefix1 . '/' . $counter;

    

                $requisition = Requisition::create([

                    'user_id' => auth()->user()->id,

                    'requisition_date' => $request->requisition_date, 

                    'requisition_no' => $requisition_no,

                    'remarks' => $request->note ?? $request->remarks ?? '', // Use the note field if remarks field is not available

                    'buyer_name' => $request->buyer_name, 

                    'address' => $request->address,

                    'sr_no' => $request->sr,

                    'requisition_type' => $request->requisition_type,

                    'company_id' => $request->company_value,

                    'status' => 0,

                    'cc'=> $request->category,

                    'auth' => $request->category_two,

                ]);

            }



            //get all temp requisition products based on user id

            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

            ->where('is_active', 1)

            ->get();



            if ($tempRequestedProducts) {

                foreach ($tempRequestedProducts as $tempRequestedProduct) {

                    RequisitionProduct::create([

                        'requisition_id' => $requisition->id,

                        'product_id' => $tempRequestedProduct->product_id,

                        'quantity' => $tempRequestedProduct->quantity,

                        'spec' => $tempRequestedProduct->spec,

                        'unit_type' => $tempRequestedProduct->unit_type,

                        'unit_price' => $tempRequestedProduct->unit_price,

                        'unit_package_size' => $tempRequestedProduct->unit_package_size,

                        'remarks' => $tempRequestedProduct->remarks,

                    ]);

                }



                // $designation = Designation::where('id', auth()->user()->designation_id)->first();



                // $department = Department::where('id', auth()->user()->department_id)->first();



                // RequisitionSignature::create([

                //     'requisition_id' => $requisition->id,

                //     'signature' => auth()->user()->signature,

                //     'date' => $requisition->requisition_date,

                //     'name' => auth()->user()->name,

                //     'designation' => $designation->designation,

                //     'department' => $department->name,

                //     'status' => 1,

                // ]);



                //delete all temp requisition products based on user id

                TempRequisitionProduct::where('user_id', auth()->user()->id)

                ->where('is_active', 1)

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



    public function noAuthRequisition(Request $request)

    {

        try {

            // Check if requisition_no exists

            if ($request->requisition_no) {

                $existingRequisition = Requisition::where('requisition_no', $request->requisition_no)->first();

                

                if ($existingRequisition) {

                    return response()->json([

                        'errors' => [

                            'requisition_no' => 'স্মারক নং ইতিমধ্যে বিদ্যমান',

                        ]

                    ], 422); // Validation error code

                }



                // Determine status before creating the requisition

                $status = ($request->requisition_type == 2) ? 14 : 1;



                $requisition = Requisition::create([

                    'user_id' => auth()->user()->id,

                    'requisition_date' => $request->requisition_date,

                    'requisition_no' => $request->requisition_no,

                    'remarks' => $request->note ?? $request->remarks ?? '', // Use the note field if remarks field is not available

                    'buyer_name' => $request->buyer_name, 

                    'address' => $request->address, 

                    'sr_no' => $request->sr,

                    'requisition_type' => $request->requisition_type,

                    'company_id' => $request->company_value,

                    'status' => $status,

                    'cc'=> $request->category,

                    'auth' => $request->category_two,

                ]);

            }else {

                $prefix1 = 'Challan';

    

                // Find last requisition number and increment the counter

                $lastRequisition = Requisition::where('requisition_no', 'like', $prefix1 . '/%')

                    ->orderBy('id', 'DESC')

                    ->first();

    

                $counter = 4000; // Default counter

                if ($lastRequisition) {

                    $lastRequisitionNoParts = explode('/', $lastRequisition->requisition_no);

                    if (isset($lastRequisitionNoParts[1]) && is_numeric($lastRequisitionNoParts[1])) {

                        $counter = (int)$lastRequisitionNoParts[1] + 1;

                    }

                }

            

                

                // Combine all parts to form the requisition number

                $requisition_no = $prefix1 . '/' . $counter;



                // Determine status before creating the requisition

                $status = ($request->requisition_type == 2) ? 14 : 1;

    

                $requisition = Requisition::create([

                    'user_id' => auth()->user()->id,

                    'requisition_date' => $request->requisition_date, 

                    'requisition_no' => $requisition_no,

                    'remarks' => $request->note ?? $request->remarks ?? '', // Use the note field if remarks field is not available

                    'buyer_name' => $request->buyer_name, 

                    'address' => $request->address, 

                    'sr_no' => $request->sr,

                    'requisition_type' => $request->requisition_type,

                    'company_id' => $request->company_value,

                    'status' => $status,

                    'cc'=> $request->category,

                    'auth' => $request->category_two,

                ]);

            }



            //get all temp requisition products based on user id

            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

            ->where('is_active', 1)

            ->get();



            if ($tempRequestedProducts) {

                foreach ($tempRequestedProducts as $tempRequestedProduct) {

                    RequisitionProduct::create([

                        'requisition_id' => $requisition->id,

                        'product_id' => $tempRequestedProduct->product_id,

                        'quantity' => $tempRequestedProduct->quantity,

                        'spec' => $tempRequestedProduct->spec,

                        'unit_type' => $tempRequestedProduct->unit_type,

                        'unit_price' => $tempRequestedProduct->unit_price,

                        'unit_package_size' => $tempRequestedProduct->unit_package_size,

                        'remarks' => $tempRequestedProduct->remarks,

                    ]);

                }



                $allocatedQuantity = RequisitionProduct::where('requisition_id', $requisition->id)->get();



                foreach ($allocatedQuantity as $quantity) {
    
                    $product = Product::where('id', $quantity->product_id)->first();
    
                    $product->allocation_quantity = $product->allocation_quantity + $quantity->quantity;
    
                    $product->final_quantity = $product->final_quantity - $quantity->quantity;
    
                    $product->temp_quantity = $product->temp_quantity - $quantity->quantity;
    
                    $product->save();
    
                }



                $designation = Designation::where('id', auth()->user()->designation_id)->first();



                $department = Department::where('id', auth()->user()->department_id)->first();

    

                RequisitionSignature::create([

                    'requisition_id' => $requisition->id,

                    'signature' => auth()->user()->signature,

                    'date' => date('Y-m-d'),

                    'name' => auth()->user()->name,

                    'designation' => $designation->designation,

                    'department' => $department->name,

                    'status' => 1,

                ]);



                //delete all temp requisition products based on user id

                TempRequisitionProduct::where('user_id', auth()->user()->id)

                ->where('is_active', 1)

                ->delete();

            }

 

            if ($requisition) {



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

                    'title' => 'New Requisition Created Without Authorization',

                    'text' => 'A new requisition has been created by ' . auth()->user()->name .  ' without your authorization' . '. Requisition No: ' . $requisition->requisition_no,

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



    public function editRequisitionUpdate(Request $request, $id)

{

    try {

        // Check if the requisition exists

        $requisition = Requisition::find($id);



        if (!$requisition) {

            return response()->json([

                'status' => false,

                'message' => 'Requisition not found',

                'data' => []

            ], 404);

        }



        // Check if the requisition number already exists, and it's not the same requisition being edited

        if ($request->requisition_no && $request->requisition_no != $requisition->requisition_no) {

            $existingRequisition = Requisition::where('requisition_no', $request->requisition_no)->first();



            if ($existingRequisition) {

                return response()->json([

                    'errors' => [

                        'requisition_no' => 'স্মারক নং ইতিমধ্যে বিদ্যমান',

                    ]

                ], 422); // Validation error code

            }

        }

        



        // Update requisition

        $requisition->update([

            'requisition_date' => $request->requisition_date,

            'requisition_no' => $request->requisition_no,

            'remarks' => $request->note ?? $request->remarks ?? '',

            'buyer_name' => $request->buyer_name,

            'address' => $request->address,

            'requisition_type' => $request->requisition_type,

            'company_id' => $request->company_value,

            'sr_no' => $request->sr,

            'status' => 0,

            'cc' => $request->category,

            'auth' => $request->category_two,

        ]);



        // Get all temp requisition products based on user id

        $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

        ->where('is_active',2)

        ->get();



        if ($tempRequestedProducts) {

            // First, delete old requisition products

            RequisitionProduct::where('requisition_id', $requisition->id)->delete();



            // Then, add new products

            foreach ($tempRequestedProducts as $tempRequestedProduct) {

                RequisitionProduct::create([

                    'requisition_id' => $requisition->id,

                    'product_id' => $tempRequestedProduct->product_id,

                    'quantity' => $tempRequestedProduct->quantity,

                    'spec' => $tempRequestedProduct->spec,

                    'unit_type' => $tempRequestedProduct->unit_type,

                    'unit_price' => $tempRequestedProduct->unit_price,

                    'unit_package_size' => $tempRequestedProduct->unit_package_size,

                    'remarks' => $tempRequestedProduct->remarks,

                ]);

            }



            // Get all temp requisition products based on user id and is_active status

            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

                ->where('is_active', 2)

                ->get();



            // Iterate through each product and delete it

            foreach ($tempRequestedProducts as $tempRequestedProduct) {

                $tempRequestedProduct->delete();

            }



            //create new notification for the requisition



            Notification::create([

                'from_user_id' => auth()->user()->id,  

                'title' => 'Requisition Updated',

                'text' => 'A requisition has been updated by ' . auth()->user()->name . '. Requisition No: ' . $requisition->requisition_no . '. Please review and authorize it.',

                'to_user_id' => auth()->user()->auth_by,

                'link' => route('requisitions.create')

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



public function editRequisitionNoAuth(Request $request, $id)

{

    try {

        // Check if the requisition exists

        $requisition = Requisition::find($id);



        if (!$requisition) {

            return response()->json([

                'status' => false,

                'message' => 'Requisition not found',

                'data' => []

            ], 404);

        }



        // Check if the requisition number already exists, and it's not the same requisition being edited

        if ($request->requisition_no && $request->requisition_no != $requisition->requisition_no) {

            $existingRequisition = Requisition::where('requisition_no', $request->requisition_no)->first();



            if ($existingRequisition) {

                return response()->json([

                    'errors' => [

                        'requisition_no' => 'স্মারক নং ইতিমধ্যে বিদ্যমান',

                    ]

                ], 422); // Validation error code

            }

        }

        



        // Update requisition

        $requisition->update([

            'requisition_date' => $request->requisition_date,

            'requisition_no' => $request->requisition_no,

            'remarks' => $request->note ?? $request->remarks ?? '',

            'buyer_name' => $request->buyer_name,

            'address' => $request->address,

            'requisition_type' => $request->requisition_type,

            'company_id' => $request->company_value,

            'sr_no' => $request->sr,

            'status' => 1,

            'cc' => $request->category,

            'auth' => $request->category_two,

        ]);



        // Get all temp requisition products based on user id

        $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

        ->where('is_active',2)

        ->get();



        if ($tempRequestedProducts) {

            // First, delete old requisition products

            RequisitionProduct::where('requisition_id', $requisition->id)->delete();



            // Then, add new products

            foreach ($tempRequestedProducts as $tempRequestedProduct) {

                RequisitionProduct::create([

                    'requisition_id' => $requisition->id,

                    'product_id' => $tempRequestedProduct->product_id,

                    'quantity' => $tempRequestedProduct->quantity,

                    'spec' => $tempRequestedProduct->spec,

                    'unit_type' => $tempRequestedProduct->unit_type,

                    'unit_price' => $tempRequestedProduct->unit_price,

                    'unit_package_size' => $tempRequestedProduct->unit_package_size,

                    'remarks' => $tempRequestedProduct->remarks,

                ]);

            }



            

            $allocatedQuantity = RequisitionProduct::where('requisition_id', $requisition->id)->get();



            foreach ($allocatedQuantity as $quantity) {

                $product = Product::where('id', $quantity->product_id)->first();

                $product->allocation_quantity = $product->allocation_quantity + $quantity->quantity;

                $product->final_quantity = $product->final_quantity - $quantity->quantity;

                $product->temp_quantity = $product->temp_quantity - $quantity->quantity;

                $product->save();

            }

            



            $designation = Designation::where('id', auth()->user()->designation_id)->first();



            $department = Department::where('id', auth()->user()->department_id)->first();



            RequisitionSignature::create([

                'requisition_id' => $requisition->id,

                'signature' => auth()->user()->signature,

                'date' => date('Y-m-d'),

                'name' => auth()->user()->name,

                'designation' => $designation->designation,

                'department' => $department->name,

                'status' => 1,

            ]);



            // Get all temp requisition products based on user id and is_active status

            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

                ->where('is_active', 2)

                ->get();



            // Iterate through each product and delete it

            foreach ($tempRequestedProducts as $tempRequestedProduct) {

                $tempRequestedProduct->delete();

            }



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

                    'title' => 'Requisition Updated Without Authorization',

                    'text' => 'A requisition has been updated by ' . auth()->user()->name . '. Requisition No: ' . $requisition->requisition_no . ' without authorization.',

                    'to_user_id' => $user->id,

                    'link' => route('requisitions.create')

                ]);

            }

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



//save draft edit requisition 

public function saveRequisitionUpdate(Request $request, $id)

{

    try {

        // Check if the requisition exists

        $requisition = Requisition::find($id);



        if (!$requisition) {

            return response()->json([

                'status' => false,

                'message' => 'Requisition not found',

                'data' => []

            ], 404);

        }



        // Check if the requisition number already exists, and it's not the same requisition being edited

        if ($request->requisition_no && $request->requisition_no != $requisition->requisition_no) {

            $existingRequisition = Requisition::where('requisition_no', $request->requisition_no)->first();



            if ($existingRequisition) {

                return response()->json([

                    'errors' => [

                        'requisition_no' => 'স্মারক নং ইতিমধ্যে বিদ্যমান',

                    ]

                ], 422); // Validation error code

            }

        }

        



        // Update requisition

        $requisition->update([

            'requisition_date' => $request->requisition_date,

            'requisition_no' => $request->requisition_no,

            'remarks' => $request->note ?? $request->remarks ?? '',

            'buyer_name' => $request->buyer_name,

            'address' => $request->address,

            'requisition_type' => $request->requisition_type,

            'company_id' => $request->company_value,

            'sr_no' => $request->sr,

            'status' => 13,

            'cc' => $request->category,

            'auth' => $request->category_two,

        ]);



        // Get all temp requisition products based on user id

        $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

        ->where('is_active',2)

        ->get();



        if ($tempRequestedProducts) {

            // First, delete old requisition products

            RequisitionProduct::where('requisition_id', $requisition->id)->delete();



            // Then, add new products

            foreach ($tempRequestedProducts as $tempRequestedProduct) {

                RequisitionProduct::create([

                    'requisition_id' => $requisition->id,

                    'product_id' => $tempRequestedProduct->product_id,

                    'quantity' => $tempRequestedProduct->quantity,

                    'spec' => $tempRequestedProduct->spec,

                    'unit_type' => $tempRequestedProduct->unit_type,

                    'unit_price' => $tempRequestedProduct->unit_price,

                    'unit_package_size' => $tempRequestedProduct->unit_package_size,

                    'remarks' => $tempRequestedProduct->remarks,

                ]);

            }



            // $designation = Designation::where('id', auth()->user()->designation_id)->first();



            // $department = Department::where('id', auth()->user()->department_id)->first();



            // // Update signature for the requisition

            // RequisitionSignature::updateOrCreate(

            //     ['requisition_id' => $requisition->id],

            //     [

            //         'signature' => auth()->user()->signature,

            //         'date' => $requisition->requisition_date,

            //         'name' => auth()->user()->name,

            //         'designation' => $designation->designation,

            //         'department' => $department->name,

            //         'status' => 1,

            //     ]

            // );



            // Get all temp requisition products based on user id and is_active status

            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

                ->where('is_active', 2)

                ->get();



            // Iterate through each product and delete it

            foreach ($tempRequestedProducts as $tempRequestedProduct) {

                $tempRequestedProduct->delete();

            }

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



    //save draft edit requisition 

    public function saveDraft_submit(Request $request, $id)

    {

        try {

            // Check if the requisition exists

            $requisition = Requisition::find($id);



            if (!$requisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition not found',

                    'data' => []

                ], 404);

            }



            // Check if the requisition number already exists, and it's not the same requisition being edited

            if ($request->requisition_no && $request->requisition_no != $requisition->requisition_no) {

                $existingRequisition = Requisition::where('requisition_no', $request->requisition_no)->first();



                if ($existingRequisition) {

                    return response()->json([

                        'errors' => [

                            'requisition_no' => 'স্মারক নং ইতিমধ্যে বিদ্যমান',

                        ]

                    ], 422); // Validation error code

                }

            }

            



            // Update requisition

            $requisition->update([

                'requisition_date' => $request->requisition_date,

                'requisition_no' => $request->requisition_no,

                'remarks' => $request->note ?? $request->remarks ?? '',

                'buyer_name' => $request->buyer_name,

                'address' => $request->address,

                'requisition_type' => $request->requisition_type,

                'company_id' => $request->company_value,

                'sr_no' => $request->sr,

                'status' => 11,

                'cc' => $request->category,

                'auth' => $request->category_two,

            ]);



            // Get all temp requisition products based on user id

            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

            ->where('is_active',2)

            ->get();



            if ($tempRequestedProducts) {

                // First, delete old requisition products

                RequisitionProduct::where('requisition_id', $requisition->id)->delete();



                // Then, add new products

                foreach ($tempRequestedProducts as $tempRequestedProduct) {

                    RequisitionProduct::create([

                        'requisition_id' => $requisition->id,

                        'product_id' => $tempRequestedProduct->product_id,

                        'quantity' => $tempRequestedProduct->quantity,

                        'spec' => $tempRequestedProduct->spec,

                        'unit_type' => $tempRequestedProduct->unit_type,

                        'unit_price' => $tempRequestedProduct->unit_price,

                        'unit_package_size' => $tempRequestedProduct->unit_package_size,

                        'remarks' => $tempRequestedProduct->remarks,

                    ]);

                }



                // $designation = Designation::where('id', auth()->user()->designation_id)->first();



                // $department = Department::where('id', auth()->user()->department_id)->first();



                // // Update signature for the requisition

                // RequisitionSignature::updateOrCreate(

                //     ['requisition_id' => $requisition->id],

                //     [

                //         'signature' => auth()->user()->signature,

                //         'date' => $requisition->requisition_date,

                //         'name' => auth()->user()->name,

                //         'designation' => $designation->designation,

                //         'department' => $department->name,

                //         'status' => 1,

                //     ]

                // );





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

                        'title' => 'New Requisition Created Without Authorization',

                        'text' => 'A new requisition has been created by ' . auth()->user()->name .  ' without your authorization' . '. Requisition No: ' . $requisition->requisition_no,

                        'to_user_id' => $user->id,

                        'link' => route('requisitions.create')

                    ]);

                }



                // Get all temp requisition products based on user id and is_active status

                $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

                    ->where('is_active', 2)

                    ->get();



                // Iterate through each product and delete it

                foreach ($tempRequestedProducts as $tempRequestedProduct) {

                    $tempRequestedProduct->delete();

                }

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

    

    /**

     * Display the specified resource.

     */

    public function show(string $id)

    {

        try {

            $requisition = Requisition::with(

            'user.designation', 

            'requisitionProducts.product', 

            'requisitionSignatures', 

            'requisitionProducts.unitType',

            'missingRequisitions.unit'

            )->find($id);



            $missingRequisitions = MissingRequisition::where('requisition_id', $id)->get();





            // dd($requisition);



            // $requisitionProducts = RequisitionProduct::where('requisition_id', $id)->with('product')->get();



            // $requisition = Requisition::with('user')->find($id);



            return view('backend.requisitions.requisition_show', compact('requisition' ,'missingRequisitions'));



        } catch (\Exception $e) {

            return view('backend.requisitions.requisition_show', compact('requisition'));

        }

    }



    public function invoiceShow(string $id)

    {

        try {

            $requisition = Requisition::with(

                'user.designation', 

                'requisitionProducts.product', 

                'requisitionSignatures', 

                'requisitionProducts.unitType',

                'missingRequisitions.unit'

            )->findOrFail($id);

    

            $missingRequisitions = MissingRequisition::where('requisition_id', $id)->get();

    

            // Check if the requisition already has an invoice number

            if (!$requisition->invoice_no) {

                // Find the last invoice number and increment it

                $lastInvoice = Requisition::whereNotNull('invoice_no')

                    ->orderBy('invoice_no', 'DESC')

                    ->first();

    

                $counter = 100; // Default starting counter 

    

                if ($lastInvoice && is_numeric($lastInvoice->invoice_no)) {

                    $counter = (int)$lastInvoice->invoice_no + 1; // Increment last invoice number

                }

    

                // Update requisition with the new invoice number (only number)

                $requisition->update([

                    'invoice_no' => $counter

                ]);

            }





            if (!$requisition->invoice_date) {

                // Find the last invoice number and increment it

                $lastInvoice = Requisition::whereNotNull('invoice_date')

                    ->orderBy('invoice_date', 'DESC')

                    ->first();



                $today = Carbon::now();

    

                // Update requisition with the new invoice number (only number)

                $requisition->update([

                    'invoice_date' => $today

                ]);

            }



    

            return view('backend.requisitions.invoice_show', compact('requisition', 'missingRequisitions'));

    

        } catch (\Exception $e) {

            return view('backend.requisitions.invoice_show', compact('requisition'));

        }

    }



    public function checkInvoiceDate($id)

    {

        $requisition = Requisition::find($id);



        if (!$requisition) {

            return response()->json(['error' => 'Requisition not found'], 404);

        }



        return response()->json(['invoice_date' => $requisition->invoice_date]);

    }

    

    public function editRequisition(string $id)

    {

        try {

            $requisition = Requisition::with(

            'user.designation', 

            'requisitionProducts.product', 

            'requisitionSignatures', 

            'requisitionProducts.product.unitType',

            'missingRequisitions.unit'

            )->find($id);



            $missingRequisitions = MissingRequisition::where('requisition_id', $id)->get();





            // dd($requisition);



            // $requisitionProducts = RequisitionProduct::where('requisition_id', $id)->with('product')->get();



            // $requisition = Requisition::with('user')->find($id);



            return view('backend.requisitions.return_requisition_show', compact('requisition' ,'missingRequisitions'));



        } catch (\Exception $e) {

            return view('backend.requisitions.return_requisition_show', compact('requisition'));

        }

    }



    public function requisitionPrint(string $id)

    {

        try {

            $requisition = Requisition::with(

                'user.designation', 

                'requisitionProducts.product', 

                'requisitionSignatures', 

                'requisitionProducts.unitType',

                'missingRequisitions.unit'

                )->find($id);

    

                $missingRequisitions = MissingRequisition::where('requisition_id', $id)->get();



            return view('backend.requisitions.requisition_print', compact('requisition', 'missingRequisitions'));



        } catch (\Exception $e) {

            return view('backend.requisitions.requisition_print', compact('requisition', 'missingRequisitions'));

        }

    }



    public function invoicePrint(string $id)

    {

        try {

            $requisition = Requisition::with(

                'user.designation', 

                'requisitionProducts.product', 

                'requisitionSignatures', 

                'requisitionProducts.unitType',

                'missingRequisitions.unit'

                )->find($id);

    

                $missingRequisitions = MissingRequisition::where('requisition_id', $id)->get();



            return view('backend.requisitions.invoice_print', compact('requisition', 'missingRequisitions'));



        } catch (\Exception $e) {

            return view('backend.requisitions.invoice_print', compact('requisition', 'missingRequisitions'));

        }

    }



    /**

     * Show the form for editing the specified resource.

     */

    public function edit(string $id)

    {

        try {

            // Fetch the missing requisitions for this requisition ID

            $missingRequisitions = MissingRequisition::where('requisition_id', $id)->get();

    

            // Initialize an empty collection for the products

            $missingProducts = collect();

    

            // Loop through each missing requisition and try to find corresponding products

            foreach ($missingRequisitions as $missingRequisition) {

                $products = Product::where('product_name', $missingRequisition->product_name)->get();

    

                // Add the found products to the $missingProducts collection

                $missingProducts = $missingProducts->merge($products);

            }

    

            // Compare the count of missing products to the count of missing requisitions

            if ($missingProducts->count() != $missingRequisitions->count()) {

                return response()->json([

                    'status' => false,

                    'message' => 'Products not found in the store. Please add products first.',

                    'data' => []

                ], 404);

            }

    

            if ($missingProducts->count() == $missingRequisitions->count()) {

                // If products are found, create RequisitionProducts

                foreach ($missingProducts as $missingProduct) {



                    $missingRequisition = MissingRequisition::where('requisition_id', $id)

                        ->where('product_name', $missingProduct->product_name)

                        ->first();

        

                    RequisitionProduct::create([

                        'requisition_id' => $id,

                        'product_id' => $missingProduct->id,

                        'quantity' => $missingRequisition->quantity,

                        'spec' => $missingRequisition->spec,

                        'remarks' => $missingRequisition->note,

                    ]);

                }

            }



            // Delete the missing requisitions

            MissingRequisition::where('requisition_id', $id)->get();



            foreach ($missingRequisitions as $missingRequisition) {

                $missingRequisition->delete();

            }

    

            return response()->json([

                'status' => true,

                'message' => 'Requisition products fetched and created successfully',

                'data' => $missingProducts

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

            $requisition = RequisitionProduct::where('requisition_id', $id)->delete();



            if (!$requisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition not found',

                    'data' => []

                ], 404);

            }



            $requisition->delete();



            return response()->json([

                'status' => true,

                'message' => 'Requisition deleted successfully',

                'data' => $requisition

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to delete requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function updateRequisitionNumber(Request $request, $id)

    {

        $request->validate([

            'requisition_no' => 'required|string|unique:requisitions,requisition_no,' . $id,

        ]);



        try {

            $requisition = Requisition::findOrFail($id);



            // Check if the new requisition number already exists

            $existingRequisition = Requisition::where('requisition_no', $request->requisition_no)->first();

            if ($existingRequisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition number already exists. Please choose a different number.',

                ]);

            }



            // Update the requisition number

            $requisition->requisition_no = $request->requisition_no;

            $requisition->save();



            return response()->json([

                'status' => true,

                'message' => 'Requisition number updated successfully.',

                'data' => $requisition,

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to update requisition number.',

                'error' => $e->getMessage(),

            ], 500);

        }

    }



    public function updateInvoiceNumber(Request $request, $id)

    {

        $request->validate([

            'invoice_no' => 'required|string|unique:requisitions,invoice_no,' . $id,

        ]);



        try {

            $invoice = Requisition::findOrFail($id);



            // Check if the new requisition number already exists

            $existingInvoice = Requisition::where('invoice_no', $request->invoice_no)->first();

            if ($existingInvoice) {

                return response()->json([

                    'status' => false,

                    'message' => 'Invoice number already exists. Please choose a different number.',

                ]);

            }



            // Update the requisition number

            $invoice->invoice_no = $request->invoice_no;

            $invoice->save();



            return response()->json([

                'status' => true,

                'message' => 'Invoice number updated successfully.',

                'data' => $invoice,

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to update invoice number.',

                'error' => $e->getMessage(),

            ], 500);

        }

    }



    public function updateOrderNumber(Request $request, $id)

    {

        $request->validate([

            'order_no' => 'required|string|unique:requisitions,order_no,' . $id,

        ]);



        try {

            $order = Requisition::findOrFail($id);



            // Check if the new requisition number already exists

            $existingOrder = Requisition::where('order_no', $request->order_no)->first();

            if ($existingOrder) {

                return response()->json([

                    'status' => false,

                    'message' => 'Order number already exists. Please choose a different number.',

                ]);

            }



            // Update the requisition number

            $order->order_no = $request->order_no;

            $order->save();



            return response()->json([

                'status' => true,

                'message' => 'Invoice number updated successfully.',

                'data' => $order,

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to update invoice number.',

                'error' => $e->getMessage(),

            ], 500);

        }

    }



    public function saveDraft(Request $request)

    {

        try {

            // Check if requisition_no exists

            if ($request->requisition_no) {

                $existingRequisition = Requisition::where('requisition_no', $request->requisition_no)->first();

                

                if ($existingRequisition) {

                    return response()->json([

                        'errors' => [

                            'requisition_no' => 'স্মারক নং ইতিমধ্যে বিদ্যমান',

                        ]

                    ], 422); // Validation error code

                }



                $requisition = Requisition::create([

                    'user_id' => auth()->user()->id,

                    'requisition_date' => $request->requisition_date,

                    'requisition_no' => $request->requisition_no,

                    'remarks' => $request->note ?? $request->remarks ?? '', // Use the note field if remarks field is not available

                    'buyer_name' => $request->buyer_name,

                    'address' => $request->address,

                    'requisition_type' => $request->requisition_type,

                    'sr_no' => $request->sr,

                    'company_id' => $request->company_value,

                    'status' => 11,

                    'cc'=> $request->category,

                    'auth' => $request->category_two,

                ]);

            }else {

                $prefix1 = 'Challan';

    

                // Find last requisition number and increment the counter

                $lastRequisition = Requisition::where('requisition_no', 'like', $prefix1 . '/%')

                    ->orderBy('id', 'DESC')

                    ->first();

    

                $counter = 4000; // Default counter

                if ($lastRequisition) {

                    $lastRequisitionNoParts = explode('/', $lastRequisition->requisition_no);

                    if (isset($lastRequisitionNoParts[1]) && is_numeric($lastRequisitionNoParts[1])) {

                        $counter = (int)$lastRequisitionNoParts[1] + 1;

                    }

                }

            

                

                // Combine all parts to form the requisition number

                $requisition_no = $prefix1 . '/' . $counter;

    

                $requisition = Requisition::create([

                    'user_id' => auth()->user()->id,

                    'requisition_date' => $request->requisition_date,

                    'requisition_no' => $requisition_no,

                    'remarks' => $request->note ?? $request->remarks ?? '', // Use the note field if remarks field is not available

                    'buyer_name' => $request->buyer_name,

                    'address' => $request->address,

                    'requisition_type' => $request->requisition_type,

                    'sr_no' => $request->sr,

                    'company_id' => $request->company_value,

                    'status' => 11,

                    'cc'=> $request->category,

                    'auth' => $request->category_two,

                ]);

            }



            //get all temp requisition products based on user id

            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

            ->where('is_active', 1)

            ->get();



            if ($tempRequestedProducts) {

                foreach ($tempRequestedProducts as $tempRequestedProduct) {

                    RequisitionProduct::create([

                        'requisition_id' => $requisition->id,

                        'product_id' => $tempRequestedProduct->product_id,

                        'quantity' => $tempRequestedProduct->quantity,

                        'spec' => $tempRequestedProduct->spec,

                        'unit_type' => $tempRequestedProduct->unit_type,

                        'unit_price' => $tempRequestedProduct->unit_price,

                        'unit_package_size' => $tempRequestedProduct->unit_package_size,

                        'remarks' => $tempRequestedProduct->remarks,

                    ]);

                }



                //delete all temp requisition products based on user id

                TempRequisitionProduct::where('user_id', auth()->user()->id)

                ->where('is_active', 1)

                ->delete();

            }

 

            if ($requisition) {



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



    public function sendDraft($id)

    {

        try {

            $requisition = Requisition::find($id);



            if (!$requisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition not found',

                    'data' => []

                ], 404);

            }



            $requisition->status = 0;

            $requisition->save();



            //create new notification for the requisition

            Notification::create([

                'from_user_id' => auth()->user()->id,

                'title' => 'New Requisition Created',

                'text' => 'A new requisition has been created by ' . auth()->user()->name . '. Requisition No: ' . $requisition->requisition_no . '. Please review and authorize it.',

                'to_user_id' => auth()->user()->auth_by,

                'link' => route('requisitions.create')

            ]);



            return response()->json([

                'status' => true,

                'message' => 'Requisition send successfully',

                'data' => $requisition

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to send requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function sendNoAuthDraft($id)

    {

        try {

            $requisition = Requisition::find($id);



            if (!$requisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition not found',

                    'data' => []

                ], 404);

            }



            $requisition->status = 0;

            $requisition->save();



            //create new notification for the requisition

            Notification::create([

                'from_user_id' => auth()->user()->id,

                'title' => 'Requisition Created Without Authorization',

                'text' => 'A new requisition has been created by ' . auth()->user()->name . '. Requisition No: ' . $requisition->requisition_no . ' without authorization.',

                'to_user_id' => auth()->user()->auth_by,

                'link' => route('requisitions.create')

            ]);



            return response()->json([

                'status' => true,

                'message' => 'Requisition send successfully',

                'data' => $requisition

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to send requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    // public function sendDeleteRequisition($id)

    // {

    //     try {

    //         $requisition = Requisition::find($id);



    //         if (!$requisition) {

    //             return response()->json([

    //                 'status' => false,

    //                 'message' => 'Requisition not found',

    //                 'data' => []

    //             ], 404);

    //         }



    //         $requisition->status = 14;

    //         $requisition->save();



    //         return response()->json([

    //             'status' => true,

    //             'message' => 'Draft requisition deleted successfully',

    //             'data' => $requisition

    //         ], 200);

    //     } catch (\Exception $e) {

    //         return response()->json([

    //             'status' => false,

    //             'message' => 'Failed to send requisition',

    //             'error' => $e->getMessage()

    //         ], 500);

    //     }

    // }



    public function returnEditRequisition($id)

    {

        try {

            $requisition = Requisition::find($id);

            $requisitionProducts = RequisitionProduct::where('requisition_id', $id)

                ->get();



                $deleteTempProduct = TempRequisitionProduct::where('is_active', 2)->get();

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

                            'is_active'=> 2,

                        ]);

                    }



                    $products = Product::where('is_active', 1)

                    ->with('unitType')

                    ->orderBy('id', 'DESC')

                    ->get();

            

                    $unitTypes = UnitType::all();

                    $company = Company::all();

            

                    return view('backend.requisitions.return_requisition_edit', compact('products', 'unitTypes','requisitionProducts','requisition','company'));



                } catch (\Exception $e) {

                    return view('backend.requisitions.return_requisition_edit', compact('products', 'unitTypes','requisitionProducts','requisition','company'));

                }     

    }

    public function tempreturnRequisition()

    {

        try {

            $tempRequestedProducts = TempRequisitionProduct::where('user_id', auth()->user()->id)

                ->where('is_active', 2)

                ->with(['product.unitType'])

                ->orderBy('id', 'ASC')

                ->get();



            // Get all unit types for the dropdown

            $unitTypes = UnitType::all();



            if ($tempRequestedProducts->isEmpty()) {

                return response()->json([

                    'status' => false,

                    'message' => 'No data found',

                    'data' => [],

                ], 404);

            }



            return response()->json([

                'status' => true,

                'message' => 'Temp requested products fetched successfully',

                'data' => $tempRequestedProducts,

                'unitTypes' => $unitTypes, 

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to fetch temp requested products',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    public function tempStore(Request $request)

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

                'is_active'=> 2, 

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





 public function returnRequisition(Request $request)

    {

        try {

            $requisition = Requisition::findOrFail($request->id);



            if (!$requisition) {

                return response()->json([

                    'status' => false,

                    'message' => 'Requisition not found',

                    'data' => []

                ], 404);

            }

            

            $signature = RequisitionSignature::where('requisition_id', $requisition->id)->get();

            foreach ($signature as $sign) {

                //delete the signature

                $sign->delete();

                }



            $requisition->status = 12; 

            $requisition->remarks = $request->reason; 

            $requisition->save();



            //create new notification for the requisition

            Notification::create([

                'from_user_id' => auth()->user()->id,

                'title' => 'Requisition Return',

                'text' => $requisition->requisition_no . ' has been returned by ' . auth()->user()->name . ' . Plese check it out.',

                'to_user_id' => $requisition->user_id,

                'link' => route('requisitions.create')

            ]);



            return response()->json([

                'status' => true,

                'message' => 'Requisition send successfully',

                'data' => $requisition

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to send requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }

    public function generateRequisition()

    {

        try {

            $user = Auth::user();

            if (!$user) {

                return response()->json([

                    'status' => false,

                    'message' => 'Unauthorized access'

                ], 401);

            }

    

            $userDepartment = $user->department_id;

    

            // Get Department name

            $department = Department::find($userDepartment);

            if (!$department) {

                return response()->json([

                    'status' => false,

                    'message' => 'Department not found'

                ], 404);

            }

    

            // Define requisition prefixes

            $prefix1 = 'Challan'; 

    

            // Start with default counter

            $counter = 4000;

    

            // Find the last requisition number and extract the counter value

            $lastRequisition = Requisition::where('requisition_no', 'like', "%$prefix1%")

                ->orderBy('id', 'DESC')

                ->first();

    

            if ($lastRequisition) {

                // Extract last counter value and increment

                $lastRequisitionNoParts = explode('/', $lastRequisition->requisition_no);

                $lastCounter = intval(end($lastRequisitionNoParts)); // Extract last part as number

                $counter = $lastCounter + 1;

            }

    

            // Generate the requisition number

            $requisition_no = "$prefix1/$counter";

    

            return response()->json([

                'status' => true,

                'message' => 'Requisition number generated successfully',

                'data' => $requisition_no

            ], 200);

    

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to generate requisition number',

                'error' => $e->getMessage()

            ], 500);

        }

    }

    



    public function deleteDraft_submit(Request $request, $id)

    {

        try {

            $requisition = Requisition::find($id);

            $requisitionProducts = RequisitionProduct::where('requisition_id', $id)->get();



            foreach ($requisitionProducts as $requisitionProduct) {

                $requisitionProduct->delete();

            }

            $requisition->delete();



            return response()->json([

                'status' => true,

                'message' => 'Draft requisition deleted successfully',

                'data' => $requisition

            ], 200);

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to delete requisition',

                'error' => $e->getMessage()

            ], 500);

        }

    }

    



}