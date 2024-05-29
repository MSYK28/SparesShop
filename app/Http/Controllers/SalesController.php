<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Products;
use App\Models\Sales;
use App\Models\SalesDetails;
use App\Models\SalesRevenue;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesController extends Controller
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
        $sales = Sales::all();
        $today = Carbon::today();
        $today_sales = Sales::whereDate('created_at', $today)->get();
        return view('pages.sales.index', compact('sales', 'today', 'today_sales'));
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
        $valid = $request->validate([
            'sale_id' => 'required',
            'customer_sale_id' => 'required',
            'saleType' => 'required',
        ]);

        $id = $request->sale_id;
        $store_sale = Sales::find($id);
        $store_sale->customer_id = $request->customer_sale_id;
        $store_sale->saleType = $request->saleType;
        $store_sale->status = 2;
        $store_sale->update();

        $revenue = SalesRevenue::where('sale_id', $id)->get();
        foreach ($revenue as $rev) {
            $rev->saleType = $request->saleType;
            $rev->customer_id = $request->customer_sale_id;
            $rev->update();
        }

        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales, $id)
    {
        $show_sales = SalesDetails::where('sale_id', $id)->get();
        $total = 0;
        $total = SalesDetails::where('sale_id', $id)->sum('total');
        $VAT = 0;
        $VAT = 16 / 100 * $total;
        $subtotal = 0;
        $subtotal = $total - $VAT;
        $sale_id = $id;
        $orders = 0;

        $customers = Customers::where('status', 1)->get();
        $sale = Sales::find($id);

        return view('pages.sales.invoice', compact('show_sales', 'total', 'customers', 'VAT', 'subtotal', 'sale_id', 'sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    public function printReceipt(Request $request, $id)
    {
        $sale = Sales::find($id);
        $show_sales = SalesDetails::where('sale_id', $id)->get();
        $total = 0;
        $total = SalesDetails::where('sale_id', $id)->sum('total');
        $VAT = 0;
        $VAT = 16 / 100 * $total;
        $subtotal = 0;
        $subtotal = $total - $VAT;
        $sale_id = $id;
        $orders = 0;
        $today = Carbon::now();

        $customers = Customers::where('status', 1)->get();
        return view('pages.sales.receipt', compact('show_sales', 'total', 'customers', 'VAT', 'subtotal', 'sale_id', 'sale', 'today'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales, Request $request, $id)
    {
        $sales_details = SalesDetails::where('sale_id', $id)->get();
        foreach ($sales_details as $sales_detail) {
            $product = Products::find($sales_detail->product_id);
            $product->quantity = $product->quantity + $sales_detail->quantity;
            $product->save();
            $sales_detail->delete();
        }
        $sales_revenue = SalesRevenue::where('sale_id', $id)->get();
        foreach ($sales_revenue as $sales_revenue) {
            $sales_revenue->delete();
        }
        $sales = Sales::find($id);
        $sales->delete();
    }
}
