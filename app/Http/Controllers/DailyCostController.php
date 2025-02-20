<?php

namespace App\Http\Controllers;

use App\Models\CostType;
use App\Models\DailyCost;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DailyCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailyCosts = DailyCost::all();
        return view('backend.cost-management.dailyCost', compact('dailyCosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('is_active', 1)->with('productSubCategory', 'unitType')->get();
        return view('backend.cost-management.dailyCost', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'cost_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'tnx_type' => 'required|string|max:255',
        ]);

        DailyCost::create($request->all());

        if($request->tnx_type == 'Income') {
            $transactionType = 1;
        } else {
            $transactionType = 2;
        }

        //find last Transaction
        $lastTransaction = Transaction::orderBy('id', 'desc')->first();


        if($transactionType == 1) {
            $balance = $lastTransaction->balance + $request->amount;
        } else {
            if(!$lastTransaction) {
                $balance = 0;
            } else {
                $balance = $lastTransaction->balance - $request->amount;
            }
        }

        Transaction::create([
            'date' => $request->date,
            'description' => $request->description,
            'amount' => $request->amount,
            'trx_type' => $transactionType,
            'trx_mode' => 'Cash',
            'balance' => $balance,
            'cost_type' => $request->cost_type,
        ]);

        return redirect()->route('daily-costs.index')->with('success', 'Daily Cost created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dailyCost = DailyCost::findOrFail($id);
        return view('backend.cost-management.show', compact('dailyCost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dailyCost = DailyCost::findOrFail($id);
        return response()->json($dailyCost); // Return JSON response
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'cost_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'tnx_type' => 'required|string|max:255',
        ]);

        $dailyCost = DailyCost::findOrFail($id);

        //find last Transaction
        $lastTransaction = Transaction::orderBy('id', 'desc')->first();

        if($dailyCost->tnx_type == 'Income') {
            $transactionType = 1;

            Transaction::create([
                'date' => $request->date,
                'description' => $dailyCost->description. '(Deleted)',
                'amount' => $dailyCost->amount,
                'trx_type' => 2,
                'trx_mode' => 'Cash',
                'balance' => $lastTransaction->balance - $dailyCost->amount,
                'cost_type' => $dailyCost->cost_type,
            ]);
        } else {
            $transactionType = 2;

            Transaction::create([
                'date' => $request->date,
                'description' => $dailyCost->description. '(Deleted)',
                'amount' => $dailyCost->amount,
                'trx_type' => 1,
                'trx_mode' => 'Cash',
                'balance' => $lastTransaction->balance + $dailyCost->amount,
                'cost_type' => $dailyCost->cost_type,
            ]);
        }            

        $letestTransaction = Transaction::orderBy('id', 'desc')->first();

        if($transactionType == 1) {
            $balance = $letestTransaction->balance + $request->amount;
        } else {
            $balance = $letestTransaction->balance - $request->amount;
        }

        $dailyCost->update($request->all());

        //find last daily cost
        $lastDailyCost = DailyCost::findOrFail($id);

        if($lastDailyCost->tnx_type == 'Income') {
            $lastTransactionType = 1;

            $lastBalance = $letestTransaction->balance + $lastDailyCost->amount;
        } else {
            $lastTransactionType = 2;

            $lastBalance = $letestTransaction->balance - $lastDailyCost->amount;
        }

        Transaction::create([
            'date' => $request->date,
            'description' => $request->description . '(Updated)',
            'amount' => $request->amount,
            'trx_type' => $lastTransactionType,
            'trx_mode' => 'Cash',
            'balance' => $lastBalance,
            'cost_type' => $request->cost_type,
        ]);


        return redirect()->route('daily-costs.index')->with('success', 'Daily Cost updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dailyCost = DailyCost::findOrFail($id);

        //find last Transaction
        $lastTransaction = Transaction::orderBy('id', 'desc')->first();

        if($dailyCost->tnx_type == 'Income') {
            $transactionType = 1;
        } else {
            $transactionType = 2;
        }

        if($transactionType == 1) {
            $balance = $lastTransaction->balance - $dailyCost->amount;
        } else {
            $balance = $lastTransaction->balance + $dailyCost->amount;
        }

        Transaction::create([
            'date' => $dailyCost->date,
            'description' => $dailyCost->description. '(Deleted)',
            'amount' => $dailyCost->amount,
            'trx_type' => $transactionType,
            'trx_mode' => 'Cash',
            'balance' => $balance,
            'cost_type' => $dailyCost->cost_type,
        ]);

        $dailyCost->delete();

        return redirect()->route('daily-costs.index')->with('success', 'Daily Cost deleted successfully.');
    }

    public function getCostTypes()
    {

        $costTypes = CostType::select('name')->distinct()->get();
        return response()->json($costTypes);
    }
}