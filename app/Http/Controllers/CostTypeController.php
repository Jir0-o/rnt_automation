<?php

namespace App\Http\Controllers;

use App\Models\CostType;
use Illuminate\Http\Request;

class CostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costTypes = CostType::all();
        return view('backend.cost-management.costType', compact('costTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.cost-management.costType');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cost_types,name',
        ]);

        CostType::create($request->all());

        return redirect()->route('cost-types.index')->with('success', 'Cost Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $costType = CostType::findOrFail($id);
        return view('backend.cost-management.show', compact('costType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $costType = CostType::findOrFail($id);
        return response()->json($costType); // Return JSON for AJAX
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cost_types,name,' . $id,
        ]);

        $costType = CostType::findOrFail($id);
        $costType->update($request->all());

        return redirect()->route('cost-types.index')->with('success', 'Cost Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $costType = CostType::findOrFail($id);
        $costType->delete();

        return redirect()->route('cost-types.index')->with('success', 'Cost Type deleted successfully.');
    }
}