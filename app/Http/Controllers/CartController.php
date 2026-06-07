<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Retailer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('pages.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $productId = $request->product_id;
        $retailerId = $request->retailer_id;
        
        $product = Product::findOrFail($productId);
        $retailer = Retailer::findOrFail($retailerId);
        $price = $product->retailers()->where('retailer_id', $retailerId)->first()->pivot->price;

        $cart = session()->get('cart', []);

        $cartKey = $productId . '_' . $retailerId;

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                'product_id' => $productId,
                'retailer_id' => $retailerId,
                'name' => $product->name,
                'retailer_name' => $retailer->name,
                'price' => $price,
                'quantity' => 1,
                'image_path' => $product->image_path
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart');
        if(isset($cart[$request->cart_key])) {
            unset($cart[$request->cart_key]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function checkoutView()
    {
        $cart = session()->get('cart', []);
        if(count($cart) == 0) return redirect()->route('cart.index')->with('error', 'Cart is empty');

        $totalAmount = 0;
        foreach($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }
        $shipping = 10.00;
        
        return view('pages.checkout', compact('cart', 'totalAmount', 'shipping'));
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if(count($cart) == 0) return redirect()->back()->with('error', 'Cart is empty');

        $totalAmount = 0;
        foreach($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'Completed'
        ]);

        foreach($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'retailer_id' => $item['retailer_id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('dashboard')->with('success', 'Checkout successful! Order added to your history.');
    }
}
