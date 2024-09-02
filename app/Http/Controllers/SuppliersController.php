<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Orders;
use App\Models\SupplierAccounts;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuppliersController extends Controller
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
        $suppliers = Suppliers::all();
        return view('pages.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:fratij_customers',
            'phone_number' => 'required|string|max:255|unique:fratij_customers',
            'bank' => 'required',
            'bank_name' => 'required',
            'bank_account' => 'required',
            'status' => 'required|string|max:255',
        ]);

        $supplier = new Suppliers();
        $supplier->name = $request->name;
        $supplier->code = $request->code;
        $supplier->email = $request->email;
        $supplier->phone_number = $request->phone_number;
        $supplier->taxID = $request->taxID;
        $supplier->bank = $request->bank;
        $supplier->bank_name = $request->bank_name;
        $supplier->bank_account = $request->bank_account;
        $supplier->status = $request->status;
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Suppliers $suppliers, $id, Request $request)
    {
        $supplier = Suppliers::find($id);
        $orders = Orders::where('supplier_id', $id)->get();
        $orders_count = $orders->count();

        $total_amount = SupplierAccounts::where('supplier_id', $id)->where('transaction_type', 1)->sum('amount');
        $paid_amount = SupplierAccounts::where('supplier_id', $id)->where('transaction_type', 2)->sum('amount');
        $balance = $total_amount - $paid_amount;
        $accounts = SupplierAccounts::where('supplier_id', $id)->get();
        return view('pages.suppliers.show', compact('supplier', 'orders', 'accounts', 'balance'));
    }

    public function transaction(Request $request)
    {
        $new_transaction = new SupplierAccounts();
        $new_transaction->supplier_id = $request->supplier_id;
        $new_transaction->transaction_id = Str::uuid();
        $new_transaction->transaction_type = 2;
        $new_transaction->cheque_number = $request->cheque_number;
        $new_transaction->amount = $request->amount;
        $new_transaction->save();

        $supplier = Suppliers::find($request->supplier_id);
        $orders = Orders::where('supplier_id', $request->supplier_id)->get();
        $orders_count = $orders->count();
        $accounts = SupplierAccounts::where('supplier_id', $request->supplier_id)->get();

        $total_amount = SupplierAccounts::where('supplier_id', $request->supplier_id)->where('transaction_type', 1)->sum('amount');
        $paid_amount = SupplierAccounts::where('supplier_id', $request->supplier_id)->where('transaction_type', 2)->sum('amount');
        $balance = $total_amount - $paid_amount;
        return view('pages.suppliers.show', compact('orders', 'supplier', 'balance', 'accounts'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suppliers $suppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suppliers $suppliers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suppliers $suppliers)
    {
        //
    }
}
