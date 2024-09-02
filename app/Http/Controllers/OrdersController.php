<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\SupplierAccounts;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function Pest\Laravel\json;

class OrdersController extends Controller
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
        $orders = Orders::all();
        $products = Products::where('reorderQty', '>', 'quantity')->get();
        return view('pages.orders.index', compact('orders'));
    }

    public function createOrder($id)
    {
        $supplier = Suppliers::find($id);
        $products = Products::where('supplier', $id)->get();
        $basket = session()->get('basket', []);

        $total = 0;
        foreach ($basket as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        response()->json(['total' => $total]);
        return view('pages.orders.createOrder', compact('basket', 'products', 'supplier', 'total'));
    }

    public function addToBasket(Request $request)
    {
        // dd($request);
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $basket = session()->get('basket', []);

        if (isset($basket[$productId])) {
            $basket[$productId]['quantity'] += $quantity;
        } else {
            $product = Products::find($productId);
            $basket[$productId] = [
                'id' => $productId,
                'name' => $product->productTitle,
                'quantity' => $quantity,
                'price' => $price,
            ];
        }
        session()->put('basket', $basket);
        return redirect()->back();
    }

    public function removeFromBasket($id, Request $request)
    {
        $basket = session()->get('basket', []);
        if (isset($basket[$id])) {
            unset($basket[$id]);
            session()->put('basket', $basket);
        }
        return redirect()->route('orders.createOrder', $request->supplier_id);
    }

    public function emptyBasket()
    {
        session()->forget('basket');
        response()->json(['success' => true]);
        return redirect()->back();
    }

    public function create()
    {
        $low_stocks = Products::all();
        foreach ($low_stocks as $low_stock) {
            if ($low_stock->quantity >= $low_stock->reorderQty) {
                response()->json(['low_stocks' => $low_stocks]);
                return view('pages.orders.create', compact('low_stocks'));
            }
        }
    }

    public function purchase(Request $request)
    {
        // dd($request);
        $basket = session()->get('basket', []);
        $total = 0;

        $new_order = new Orders();
        $new_order->orderCode = Str::uuid();
        $new_order->supplier_id = $request->supplier_id;
        $new_order->total = $total;
        $new_order->status = 1; // order created
        $new_order->save();

        $order_id = $new_order->id;

        foreach ($basket as $item) {
            $order_detail = new OrderDetails();
            $order_detail->order_id = $order_id;
            $order_detail->product_id = $item['id'];
            $order_detail->quantity = $item['quantity'];
            $order_detail->save();
        }

        session()->forget('basket');

        return redirect()->route('orders.index');
    }


    public function store(Request $request)
    {
        // dd($request);
        $order_id = $request->order_id;
        $received_order = Orders::find($order_id);
        $received_order->total = 100000;
        $received_order->status = 2; // order received
        $received_order->save();

        $product_count = count($request->product_id);
        $subtotal = 0;
        for ($i = 0; $i < $product_count; $i++) {
            $order_detail = OrderDetails::where('order_id', $order_id)->where('product_id', $request->product_id[$i])->first();
            $order_detail->quantity_received = $request->quantity_received[$i];
            $order_detail->price = $request->price[$i];
            $order_detail->total = $request->price[$i] * $request->quantity_received[$i];
            $subtotal =+ $request->price[$i] * $request->quantity_received[$i];
            $order_detail->save();

            $product = Products::find($request->product_id[$i]);
            $product->quantity += $request->quantity_received[$i];
            $product->productBuyingPrice = $request->price[$i];
            $product->save();
        }
        $received_order->total = $request->subtotal;
        $received_order->save();

        $supplier_account = new SupplierAccounts();
        $supplier_account->supplier_id = $received_order->supplier_id;
        $supplier_account->transaction_id = $received_order->orderCode;
        $supplier_account->transaction_type = 1;
        $supplier_account->amount = $request->subtotal;
        $supplier_account->save();

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders, $id)
    {
        $order = Orders::find($id);
        $order_details = OrderDetails::where('order_id', $id)->get();
        $total = 0;
        $total = OrderDetails::where('order_id', $id)->sum('total');
        $order_id = $id;
        $orders_count = 0;

        return view('pages.orders.show', compact('order', 'order_details', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
