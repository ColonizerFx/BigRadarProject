<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ContactMessage;

class PageController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::take(4)->get();
        $marketplaceItems = \App\Models\MarketplaceListing::where('status', 'Active')->take(5)->get();
        return view('pages.index', compact('featuredProducts', 'marketplaceItems'));
    }

    public function products()
    {
        $products = Product::all();
        return view('pages.products', compact('products'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product-details', compact('product'));
    }

    public function marketplace()
    {
        $listings = \App\Models\MarketplaceListing::where('status', 'Active')->get();
        return view('pages.marketplace', compact('listings'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        ContactMessage::create($validated);

        return redirect('/contact')->with('success', 'Your message has been sent successfully!');
    }
}
