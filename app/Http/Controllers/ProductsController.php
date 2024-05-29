<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Suppliers;
use App\Providers\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
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
        $products = Products::all();
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Suppliers::all();
        return view('pages.products.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier' => 'required|max:255',
            'productTitle' => 'required',
            'productBarcode' => 'required',
            'quantity' => 'required|numeric',
            'reorderQty' => 'required|numeric',
            'productPrice' => 'required|numeric',
            'productBuyingPrice' => 'required|numeric',
            'productDiscountedPrice' => 'required|numeric',
        ]);

        $product = Products::create($validatedData);

        return response()->json($product);
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        $products = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $products[] = [
                    'productBarcode' => $data[2],
                    'productBuyingPrice' => intval($data[5]),
                    'productDiscountedPrice' => intval($data[7]),
                    'productPrice' => intval($data[6]),
                    'productTitle' => $data[1],
                    'quantity' => intval($data[3]),
                    'reorderQty' => intval($data[4]),
                    'supplier_id' => intval($data[0]),
                ];
            }
            fclose($handle);
        }

        Products::insert($products);
        return redirect()->route('products.index')->with('success', 'Products imported successfully.');
    }

    public function importXLS(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        $products = Excel::toArray(new ProductsImport, $filePath);

        Products::insert($products[0]);

        return redirect()->route('products.index')->with('success', 'Products imported successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Products $products, $id)
    {
        $product = Products::find($id);
        $html = view('products.show', compact('product'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products, $id)
    {
        $product = Products::find($id);
        $suppliers = Suppliers::all();
        return view('pages.products.edit', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products, $id)
    {
        $product = Products::find($id);

        $validatedData = $request->validate([
            'supplier' => 'required|max:255',
            'productTitle' => 'required',
            'productBarcode' => 'required',
            'quantity' => 'required|numeric',
            'reorderQty' => 'required|numeric',
            'productPrice' => 'required|numeric',
            'productBuyingPrice' => 'required|numeric',
            'productDiscountedPrice' => 'required|numeric',
        ]);

        $product->update($validatedData);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
