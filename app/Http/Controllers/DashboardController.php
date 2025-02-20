<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
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

        // Low stock alert
        $lowStock = Product::where('final_quantity', '<=', 10)->get();

        $expiringProduct = Product::whereBetween('expiry_date', [Carbon::now(), Carbon::now()->addDays(7)])
            ->get();
        



        return view('dashboard', compact('products','lowStock','expiringProduct'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
