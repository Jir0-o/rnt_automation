<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\UnitType;
use App\Models\Committee;
use App\Models\Allocation;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Requisition;
use App\Models\IssueVoucher;
use App\Models\ModelHasRole;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\InitiatorFile;
use App\Models\LeisureAccept;
use App\Models\AllocatedProduct;
use App\Models\DefaultCommittee;
use App\Models\ProductCommittee;
use App\Models\ImportantPurchase;
use App\Models\CommitteeSignature;
use App\Models\RequisitionProduct;
use Illuminate\Support\Facades\DB;
use App\Models\LeisureDistribution;
use Illuminate\Support\Facades\Log;

class CommitteeController extends Controller
{
    public function leisureReport(){
        $products = Product::where('is_active', 1)->with('productSubCategory.productCategory')->get();
        return view('backend.initiator_file.leisureReport', compact('products'));
    }

    public function auditReport(Request $request){
        $productId = $request->query('product_id');
        $product = Product::where('id', $productId)->where('is_active', 1)->with('productSubCategory.productCategory')->first();
        $leisureaccept = LeisureAccept::where('product_id', $productId)->with('unitType')->get();
        $leisuredistribution = LeisureDistribution::where('product_id', $productId)->get();
        $unitType= UnitType::where('id',$product->unit_type_id)->first();
    
        // Fetch all products in the same category to calculate the page number
        $productsInCategory = Product::where('is_active', 1)->whereHas('productSubCategory.productCategory', function($query) use ($product) {
            $query->where('id', $product->productSubCategory->productCategory->id);
        })->get();
    
        // Determine page number based on position within category
        $pageNumber = $productsInCategory->pluck('id')->search($productId) + 1;
    
        // Other logic remains the same
        $storeNames = [];
        foreach ($leisureaccept as $accept) {
            $storeUser = User::find($accept->store_id);
            $storeNames[$accept->id] = $storeUser ? $storeUser->name : null;
        }
    
        $storeSignatures = [];
        $officerSignatures = [];
        foreach ($leisuredistribution as $distribution) {
            $storeUser = User::find($distribution->store_signature_id);
            $officerUser = User::find($distribution->officer_signature_id);
            $storeSignatures[$distribution->id] = $storeUser ? $storeUser->signature : null;
            $officerSignatures[$distribution->id] = $officerUser ? $officerUser->signature : null;
        }
    
        return view('backend.initiator_file.auditReport', compact('storeNames','leisuredistribution', 'leisureaccept', 'product','unitType', 'storeSignatures', 'officerSignatures', 'pageNumber'));
    }

    public function printAuditReport($id){
        $product = Product::where('id', $id)->where('is_active', 1)->with('productSubCategory.productCategory')->first();
        $leisureaccept = LeisureAccept::where('product_id', $id)->with('unitType')->get();
        $leisuredistribution = LeisureDistribution::where('product_id', $id)->get();
        $unitType= UnitType::where('id',$product->unit_type_id)->first();
    
        // Fetch all products in the same category to calculate the page number
        $productsInCategory = Product::where('is_active', 1)->whereHas('productSubCategory.productCategory', function($query) use ($product) {
            $query->where('id', $product->productSubCategory->productCategory->id);
        })->get();
    
        // Determine page number based on position within category
        $pageNumber = $productsInCategory->pluck('id')->search($id) + 1;
    
        // Other logic remains the same
        $storeNames = [];
        foreach ($leisureaccept as $accept) {
            $storeUser = User::find($accept->store_id);
            $storeNames[$accept->id] = $storeUser ? $storeUser->name : null;
        }
    
        $storeSignatures = [];
        $officerSignatures = [];
        foreach ($leisuredistribution as $distribution) {
            $storeUser = User::find($distribution->store_signature_id);
            $officerUser = User::find($distribution->officer_signature_id);
            $storeSignatures[$distribution->id] = $storeUser ? $storeUser->signature : null;
            $officerSignatures[$distribution->id] = $officerUser ? $officerUser->signature : null;
        }
        // dd($storeSignatures);
        return view('backend.initiator_file.printAuditReport', compact('storeNames','leisuredistribution', 'leisureaccept', 'product','unitType', 'storeSignatures', 'officerSignatures', 'pageNumber'));
    }

    public function designationsIndex(){

        $designations = Designation::all()->where('is_active', 1);
        return view('backend.allocations.designation', compact('designations'));
    }

    public function designationsUpdate(Request $request)
    {
        $request->validate([
            'designation_id' => 'required|exists:designations,id',
            'designation' => 'required|string|max:255',
            'short' => 'nullable|string|max:255',
        ]);

        $designation = Designation::find($request->designation_id);
        $designation->designation = $request->designation;
        $designation->short = $request->short;
        $designation->save();

        return redirect()->route('designations.index')->with('success', 'Designation updated successfully!');
    }

    public function designationsDelete(Request $request)
    {
        $request->validate([
            'designation_id' => 'required|exists:designations,id',
        ]);

        $designation = Designation::find($request->designation_id);
        $designation->is_active = 0;
        $designation->save();

        return response()->json(['success' => true]);
    }

    public function designationsStore(Request $request)
    {
        Designation::create([
            'designation' => $request->designation,
            'short' => $request->short,
            'is_active' => 1,
        ]);

        return redirect()->back()->with('success', 'Designation created successfully!');
    }
}
