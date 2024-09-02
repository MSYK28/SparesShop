<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Sales;
use App\Models\SalesDetails;
use App\Models\SalesRevenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Products::all();
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        response()->json(['total' => $total]);
        return view('home', compact('products', 'cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('productId');
        $product_quantity = Products::where('id', $productId)->first();
        $quantity = $request->input('quantity');


        if ($product_quantity->quantity > $quantity) {
            # code...
            $price = $request->input('price');
            $cart = session()->get('cart', []);
    
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $product = Products::find($productId);
                // $newItem = [
                //     'id' => $productId,
                //     'name' => $product->productTitle,
                //     'quantity' => $quantity,
                //     'price' => $price,
                // ];
                // $cart = array_merge([$productId => $newItem], $cart);
                $cart[$productId] = [
                    'id' => $productId,
                    'name' => $product->productTitle,
                    'quantity' => $quantity,
                    'price' => $price,
                ];
            }
            session()->put('cart', $cart);
            return redirect()->back();
        }
        else
        {
            return redirect()->back()->with('error', 'Sorry, item is out of stock');
        }
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('home', compact('cart'));
    }

    public function removeFromCart($id, Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            // $cart = array_values($cart);
            session()->put('cart', $cart);
        }
        return redirect()->route('home.index');
    }

    public function emptyCart()
    {
        session()->forget('cart');
        response()->json(['success' => true]);
        return redirect()->back();
    }

    public function getCartTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return response()->json(['total' => $total]);
    }

    public function purchase(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $new_sale = new Sales();
        $new_sale->sale_code = Str::uuid();
        $new_sale->customer_id = 1; //Auth::user()->id;
        $new_sale->saleType = 0;
        $new_sale->total = $total;
        $new_sale->status = 1; // order created
        $new_sale->save();

        $sale_id = $new_sale->id;

        foreach ($cart as $item) {
            $product = Products::find($item['id']);
            $product->quantity -= $item['quantity'];
            $product->save();
    
            $sale_detail = new SalesDetails();
            $sale_detail->sale_id = $sale_id;
            $sale_detail->product_id = $item['id'];
            $sale_detail->quantity = $item['quantity'];
            $sale_detail->price = $item['price'];
            $sale_detail->total = $item['quantity'] * $item['price'];
            $sale_detail->save();
            
            $purchase = $item['quantity'] * $product['productBuyingPrice'];

            $sale_revenue = new SalesRevenue();
            $sale_revenue->sale_id = $sale_id;  
            $sale_revenue->SaleType = 0;  
            $sale_revenue->customer_id = 1;
            $sale_revenue->product_id = $item['id'];;
            $sale_revenue->amount = $sale_detail->total - $purchase;
            $sale_revenue->save();
        }
        
        session()->forget('cart');

        return redirect()->route('sales.show', $sale_id);
    }

    public function store(Request $request)
    {

    }
}
