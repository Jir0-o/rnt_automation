<?php



namespace App\Http\Controllers;



use App\Models\UnitType;

use Illuminate\Http\Request;



class UnitTypeController extends Controller

{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('permission:Can Access Unit Type')->only(['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']);
    }

    /**

     * Display a listing of the resource.

     */

    public function index()

    {

        try {

            $unitType = UnitType::all();



            if($unitType->isEmpty()) {

                return response()->json([

                    'status' => false,

                    'message' => 'No unit Type found',

                    'data' => []

                ], 404);

            }

            

            return response()->json([

                'status' => true,

                'message' => 'unit Type retrieved successfully',

                'data' => $unitType

            ], 200);



        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to retrieve unit Type',

                'error' => $e->getMessage()

            ], 500);

        }

    }



    /**

     * Show the form for creating a new resource.

     */

    public function create()

    {

        $unitType = UnitType::latest()->get();



       return view('backend.products.createUnitType', compact('unitType'));

    }



    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)

    {

        try {

            $validated = $request->validate([

                'full_name' => 'required|string',

                'short_name' => 'required|string',

            ]);

    

            $unitType = new UnitType();

            $unitType->name = $validated['full_name'];

            $unitType->symbol = $validated['short_name'];

            $unitType->save();

    

            return response()->json([

                'status' => true,

                'message' => 'Unit Type created successfully',

                'data' => $unitType

            ], 201);

    

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to create unit Type',

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

            $unitType = UnitType::find($id);

    

            if (!$unitType) {

                return response()->json([

                    'status' => false,

                    'message' => 'Unit Type not found',

                    'data' => null

                ], 404);

            }

            

            return response()->json([

                'status' => true,

                'message' => 'Unit Type retrieved successfully',

                'data' => $unitType

            ], 200);

    

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to retrieve unit Type',

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

            $validated = $request->validate([

                'full_name' => 'required|string',

                'short_name' => 'required|string',

            ]);

    

            $unitType = UnitType::find($id);

    

            if (!$unitType) {

                return response()->json([

                    'status' => false,

                    'message' => 'Unit Type not found',

                    'data' => null

                ], 404);

            }

    

            $unitType->name = $validated['full_name'];

            $unitType->symbol = $validated['short_name'];

            $unitType->save();

    

            return response()->json([

                'status' => true,

                'message' => 'Unit Type updated successfully',

                'data' => $unitType

            ], 200);

    

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to update unit Type',

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

            $unitType = UnitType::find($id);

    

            if (!$unitType) {

                return response()->json([

                    'status' => false,

                    'message' => 'Unit Type not found',

                    'data' => null

                ], 404);

            }

    

            $unitType->delete();

    

            return response()->json([

                'status' => true,

                'message' => 'Unit Type deleted successfully',

                'data' => $unitType

            ], 200);

    

        } catch (\Exception $e) {

            return response()->json([

                'status' => false,

                'message' => 'Failed to delete unit Type',

                'error' => $e->getMessage()

            ], 500);

        }

    }

}

