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

    public function products(Request $request)
    {
        $query = Product::with('retailers');

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('category', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('retailer') && is_array($request->retailer)) {
            $query->whereHas('retailers', function($q) use ($request) {
                $q->whereIn('name', $request->retailer);
            });
        }

        $products = $query->get();
        return view('pages.products', compact('products'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product-details', compact('product'));
    }

    public function marketplace(Request $request)
    {
        $query = \App\Models\MarketplaceListing::where('status', 'Active');

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('condition') && is_array($request->condition)) {
            $query->whereIn('condition', $request->condition);
        }

        if ($request->has('location') && is_array($request->location)) {
            $query->whereIn('location', $request->location);
        }

        $listings = $query->latest()->get();
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
