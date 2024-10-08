<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use App\Models\ConsolidatedDaily;
use App\Models\CustomerTransactions;
use App\Models\Sales;
use App\Models\SalesRevenue;
use App\Models\SupplierAccounts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.analytics.index');
    }

    public function checkPassword(Request $request)
    {
        $password = $request->input('password');

        if ($password === '@Jawaka73') {
            return redirect()->route('analytics.create');
        } else {
            return redirect()->back()->withErrors(['password' => 'Invalid password']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->has('start_date') && $request->has('end_date')) {
            $sales = $this->filter($request);
            return view('pages.analytics.create', compact('sales'));
        } else {
            $sales = Sales::all();
        }
        // TODAY SALES
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $total_sales = Sales::whereDate('created_at', $today)->sum('total');
        $cash_sales = Sales::whereDate('created_at', $today)->where('saleType', 1)->sum('total');
        $revenue = SalesRevenue::whereDate('created_at', $today)->where('saleType', 1)->sum('amount');
        // dd($revenue);

        // ALL SALES 
        $all_credit_sales = Sales::where('saleType', 2)->sum('total');
        $all_cash_sales = Sales::where('saleType', 1)->sum('total');
        $all_credit_paid = CustomerTransactions::sum('amount');
        $owed = $all_credit_sales - $all_credit_paid;

        // MONTHLY SALES
        $monthlySales = DB::table('fratij_sales')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total_sales')
            ->whereBetween('created_at', ['2024-09-01', '2024-09-30'])
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $totalSales = $monthlySales->sum('total_sales');
        $cashSales = DB::table('fratij_sales')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total_sales')
            ->whereBetween('created_at', ['2024-09-01', '2024-09-30'])
            ->where('saleType', 1)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $totalCashSales = $cashSales->sum('total_sales');
        $monthlyRevenue = DB::table('fratij_sales_revenue')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total_sales')
            ->whereBetween('created_at', ['2024-09-01', '2024-09-30'])
            ->where('saleType', 1)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $totalMonthlyRevenue = $monthlyRevenue->sum('total_sales');
        
        // SUPPLIER STATISTICS
        $total_invoice = SupplierAccounts::where('transaction_type', 1)->sum('amount');
        $total_paid = SupplierAccounts::where('transaction_type', 2)->sum('amount');

        // CONSOLIDATED STATISTICS
        $consolidated = ConsolidatedDaily::all();

        return view('pages.analytics.create', compact('today', 'total_sales', 'cash_sales', 'revenue', 
        'all_credit_sales', 'all_credit_paid', 'owed', 
        'monthlySales', 'cashSales', 'totalSales', 'totalCashSales', 'totalMonthlyRevenue',
        'total_invoice', 'total_paid', 'sales', 'consolidated'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        dd($startDate);
        
        // Fetch sales data for the selected date range
        $sales = Sales::whereBetween('created_at', [$startDate, $endDate])->get();      
        dd($sales);  
        // Return the filtered sales data to the view
        return view('pages.analytics.create', compact('sales'));
    }

    public function storeDaily(Request $request)
    {
        $validatedData = $request->validate([
            'cash_sales' => 'required|string|max:255',
            'credit_sales' => 'required|string|max:255',
            'revenue' => 'required|string|max:255',
            'date' => 'required',
        ]);

        ConsolidatedDaily::create($validatedData);

        return redirect()->back()->with('success', 'Customer added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Analytics $analytics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Analytics $analytics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Analytics $analytics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Analytics $analytics)
    {
        //
    }
}
