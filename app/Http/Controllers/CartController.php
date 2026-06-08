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

    public function buyMarketplaceListing($id)
    {
        $listing = \App\Models\MarketplaceListing::with('user')->findOrFail($id);

        $cart = session()->get('cart', []);
        $cartKey = 'marketplace_' . $id;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                'product_id'    => null,
                'retailer_id'   => null,
                'name'          => $listing->title,
                'retailer_name' => $listing->user->name . ' (Marketplace)',
                'price'         => $listing->price,
                'quantity'      => 1,
                'image_path'    => $listing->image_path,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.checkout.view')->with('success', 'Item added! Review your order below.');
    }

    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($order->status === 'Cancelled') {
            return redirect()->route('dashboard')->with('error', 'Order is already cancelled.');
        }

        $order->update(['status' => 'Cancelled']);
        return redirect()->route('dashboard')->with('success', 'Order #' . $id . ' has been cancelled.');
    }

    public function addBuild(Request $request)
    {
        $productIds = array_filter((array) $request->input('product_ids', []));

        if (empty($productIds)) {
            return redirect()->back()->with('error', 'Please select at least one part.');
        }

        $cart = session()->get('cart', []);

        foreach ($productIds as $productId) {
            $product = Product::with('retailers')->find($productId);
            if (!$product) continue;

            $cheapestRetailer = $product->retailers->sortBy('pivot.price')->first();
            if (!$cheapestRetailer) continue;

            $price = $cheapestRetailer->pivot->price;
            $cartKey = $productId . '_' . $cheapestRetailer->id;

            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity']++;
            } else {
                $cart[$cartKey] = [
                    'product_id'    => $productId,
                    'retailer_id'   => $cheapestRetailer->id,
                    'name'          => $product->name,
                    'retailer_name' => $cheapestRetailer->name,
                    'price'         => $price,
                    'quantity'      => 1,
                    'image_path'    => $product->image_path,
                ];
            }
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'PC build added to cart!');
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
            if (!empty($item['product_id'])) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'retailer_id'=> $item['retailer_id'],
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                ]);
            }
        }

        session()->forget('cart');
        return redirect()->route('dashboard')->with('success', 'Checkout successful! Order added to your history.');
    }
}
