<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('permission:Can Access Create Invoice')->only(['index', 'create', 'store', 'update']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoiceNo = Requisition::where('status', 1)->where('invoice_no', '=', null)->orderBy('created_at', 'desc')->get();

        return view('backend.requisitions.invoice_add', compact('invoiceNo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $requisition = Requisition::where('status', 1)->where('invoice_no', '!=', null)->orderBy('created_at', 'desc')->get();

        return view('backend.requisitions.invoice_create', compact('requisition'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    
                $requisition = Requisition::with(
    
                    'user.designation', 
    
                    'requisitionProducts.product', 
    
                    'requisitionSignatures', 
    
                    'requisitionProducts.unitType',
    
                    'missingRequisitions.unit'
    
                )->findOrFail($id);
    
                //update Requisition
    
                $requisition->update([
    
                    'invoice_no' => $request->invoice_no,
                    'invoice_date' => $request->invoice_date,
    
                ]);
    
                return view('backend.requisitions.invoice_show', compact('requisition', 'missingRequisitions'));
    
        
    
            } catch (\Exception $e) {
    
                return view('backend.requisitions.invoice_show', compact('requisition'));
    
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function invoiceGenerate()
    {
        try {
            // Find the last invoice number and increment it
            $lastInvoice = Requisition::whereNotNull('invoice_no')
                ->orderBy('invoice_no', 'DESC')
                ->first();
    
            $counter = 100; // Default starting counter
    
            if ($lastInvoice && is_numeric($lastInvoice->invoice_no)) {
                $counter = (int)$lastInvoice->invoice_no + 1; // Increment last invoice number
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Invoice number generated successfully.',
                'invoice_no' => $counter
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating invoice number.',
                'error' => $e->getMessage()
            ], 500);
        }
    }    
}
