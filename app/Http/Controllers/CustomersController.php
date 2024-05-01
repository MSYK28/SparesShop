<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\CustomerTransactions;
use App\Models\Sales;
use Illuminate\Http\Request;

class CustomersController extends Controller
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
        $customers = Customers::all();
        return view('pages.customers.index', compact('customers'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:fratij_customers',
            'taxID' => 'string|max:255|unique:fratij_customers',
            'phone_number' => 'required|string|max:255|unique:fratij_customers',
            'status' => 'required|string|max:255',
        ]);

        $customer = Customers::create($validatedData);

        return redirect()->back()->with('success', 'Customer added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customers $customers, $id)
    {
        $customer = Customers::findOrFail($id);
        return response()->json($customer);
    }

    public function showCustomerInfo($id)
    {
        $customer = Customers::findOrFail($id);
        $sales = Sales::where([['customer_id', $id], ['saleType', 2]])->get();
        $total = 0;
        $total = Sales::where([['customer_id', $id], ['saleType', 2]])->sum('total');
        $balance = 0;
        $transactions = CustomerTransactions::where('customer_id', $id)->get();
        $balance = CustomerTransactions::where('customer_id', $id)->sum('amount');
        return view('pages.customers.show', compact('customer', 'sales', 'total', 'transactions', 'balance'));
    }

    public function transactions(Request $request)
    {
        $id = $request->customer_id;
        $amount = $request->amount;
        $balance = CustomerTransactions::where('customer_id', $id)->sum('amount');

        if ($amount >= $balance) {
            $transactions = new CustomerTransactions();
            $transactions->customer_id = $id;
            $transactions->mpesa_code = $request->mpesa_code;
            $transactions->amount = $amount;
            $transactions->save();
            return redirect()->back();
        } 
        else 
        {
            return redirect()->back()->with('error', 'Amount is greater than balance');
        }
    }
    
    
    public function edit(Customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customers $customers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customers $customers)
    {
        //
    }
}
