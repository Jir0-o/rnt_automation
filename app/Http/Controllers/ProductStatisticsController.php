<?php

namespace App\Http\Controllers;

use App\Models\DailyCost;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductStatisticsController extends Controller
{
    // Get today's total allocation quantity
    public function getTodaysAllocationQuantity()
    {
        $today = Carbon::today();
        $totalAllocationQuantity = Product::whereDate('created_at', $today)
            ->sum('allocation_quantity');

        return response()->json([
            'status' => true,
            'message' => 'Today\'s total allocation quantity fetched successfully',
            'data' => $totalAllocationQuantity
        ]);
    }

    // Get today's total sales based on allocation quantity
    public function getTodaysSales()
    {
        $today = Carbon::today();
        $totalSales = Product::whereDate('created_at', $today)
            ->sum(DB::raw('allocation_quantity * unit_price'));

        return response()->json([
            'status' => true,
            'message' => 'Today\'s total sales fetched successfully',
            'data' => $totalSales
        ]);
    }

    // Get this month's total allocation quantity
    public function getMonthlyAllocationQuantity()
    {
        $monthStart = Carbon::now()->startOfMonth();
        $totalAllocationQuantity = Product::whereBetween('created_at', [$monthStart, Carbon::now()])
            ->sum('allocation_quantity');

        return response()->json([
            'status' => true,
            'message' => 'This month\'s total allocation quantity fetched successfully',
            'data' => $totalAllocationQuantity
        ]);
    }

    // Get this month's total sales based on allocation quantity
    public function getMonthlySales()
    {
        $monthStart = Carbon::now()->startOfMonth();
        $totalSales = Product::whereBetween('created_at', [$monthStart, Carbon::now()])
            ->sum(DB::raw('allocation_quantity * unit_price'));

        return response()->json([
            'status' => true,
            'message' => 'This month\'s total sales fetched successfully',
            'data' => $totalSales
        ]);
    }

    // Get monthly report
    public function getMonthlyReport()
    {
        $currentYear = Carbon::now()->year;
        $monthlySales = Product::selectRaw('MONTH(created_at) as month, SUM(allocation_quantity * unit_price) as total_sales')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total_sales', 'month')->toArray();

        // Initialize all months with zero sales
        $monthlyReport = array_fill(1, 12, 0);

        // Fill the months with actual sales
        foreach ($monthlySales as $month => $sales) {
            $monthlyReport[$month] = $sales;
        }

        return response()->json([
            'status' => true,
            'message' => 'Monthly report fetched successfully',
            'data' => array_values($monthlyReport)
        ]);
    }

    // Get yearly report
    public function getYearlyReport()
    {
        $yearsSales = Product::selectRaw('YEAR(created_at) as year, SUM(allocation_quantity * unit_price) as total_sales')
            ->groupBy('year')
            ->pluck('total_sales', 'year')->toArray();

        $years = array_keys($yearsSales);
        $sales = array_values($yearsSales);

        return response()->json([
            'status' => true,
            'message' => 'Yearly report fetched successfully',
            'data' => [
                'years' => $years,
                'sales' => $sales
            ]
        ]);
    }

    public function getMonthlyCost()
    {
        $currentYear = Carbon::now()->year;
        $monthlySales = DailyCost::selectRaw('MONTH(created_at) as month, SUM(amount) as total_sales')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total_sales', 'month')->toArray();

        // Initialize all months with zero sales
        $monthlyReport = array_fill(1, 12, 0);

        // Fill the months with actual sales
        foreach ($monthlySales as $month => $sales) {
            $monthlyReport[$month] = $sales;
        }

        return response()->json([
            'status' => true,
            'message' => 'Monthly report fetched successfully',
            'data' => array_values($monthlyReport)
        ]);
    }

    public function getYearlyCost()
    {
        $yearsSales = DailyCost::selectRaw('YEAR(created_at) as year, SUM(amount) as total_sales')
            ->groupBy('year')
            ->pluck('total_sales', 'year')->toArray();

        $years = array_keys($yearsSales);
        $sales = array_values($yearsSales);

        return response()->json([
            'status' => true,
            'message' => 'Yearly report fetched successfully',
            'data' => [
                'years' => $years,
                'sales' => $sales
            ]
        ]);
    }
}
