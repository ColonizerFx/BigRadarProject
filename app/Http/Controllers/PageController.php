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

    public function devices(Request $request)
    {
        // Devices = consumer electronics (not PC components)
        $deviceCategories = ['Apple Devices', 'Windows Laptop', 'Monitor', 'Laptop', 'Tablet', 'Smartphone', 'Watch'];
        $query = Product::with('retailers')->whereIn('category', $deviceCategories);

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('brand', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand', $request->brand);
        }

        if ($request->has('sort') && $request->sort == 'newest') {
            $query->latest();
        }

        $products = $query->get();

        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $products = $products->sortBy(function($prod) {
                    return $prod->retailers->min('pivot.price') ?? 999999;
                });
            } elseif ($request->sort == 'price_desc') {
                $products = $products->sortByDesc(function($prod) {
                    return $prod->retailers->min('pivot.price') ?? 0;
                });
            }
        }
        return view('pages.devices', compact('products'));
    }

    public function pcBuilder()
    {
        // Load all PC part categories grouped for the builder
        $partCategories = [
            'CPU'           => 'Processor',
            'GPU'           => 'Graphics Card',
            'Motherboard'   => 'Motherboard',
            'RAM'           => 'Memory',
            'Storage'       => 'Storage',
            'Power Supply'  => 'Power Supply',
            'PC Case'       => 'PC Case',
            'Cooling'       => 'Cooling & Fans',
        ];

        $partsBySlot = [];
        foreach ($partCategories as $slotLabel => $dbCategory) {
            $partsBySlot[$slotLabel] = Product::with('retailers')
                ->where('category', $dbCategory)
                ->get();
        }

        return view('pages.pc-builder', compact('partsBySlot', 'partCategories'));
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

        $selectedRetailers = array_filter((array) $request->input('retailer', []));
        if (!empty($selectedRetailers)) {
            $query->whereHas('retailers', function($q) use ($selectedRetailers) {
                $q->whereIn('name', $selectedRetailers);
            });
        }

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brand', $request->brand);
        }

        // We can optionally sort by price by joining the retailer pivot table,
        // but since we get the min price per product, sorting by price directly 
        // at the DB level is tricky without raw queries or complex subqueries.
        // For simplicity, we'll sort the final collection if requested.
        if ($request->has('sort') && $request->sort == 'newest') {
            $query->latest();
        }

        $products = $query->get();

        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $products = $products->sortBy(function($prod) {
                    return $prod->retailers->min('pivot.price') ?? 999999;
                });
            } elseif ($request->sort == 'price_desc') {
                $products = $products->sortByDesc(function($prod) {
                    return $prod->retailers->min('pivot.price') ?? 0;
                });
            }
        }
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

        $selectedConditions = array_filter((array) $request->input('condition', []));
        if (!empty($selectedConditions)) {
            $query->whereIn('condition', $selectedConditions);
        }

        $selectedLocations = array_filter((array) $request->input('location', []));
        if (!empty($selectedLocations)) {
            $query->whereIn('location', $selectedLocations);
        }

        if ($request->sort === 'newest' || !$request->sort) {
            $query->latest();
        }

        $listings = $query->get();

        if ($request->sort === 'price_asc') {
            $listings = $listings->sortBy('price');
        } elseif ($request->sort === 'price_desc') {
            $listings = $listings->sortByDesc('price');
        }

        return view('pages.marketplace', compact('listings'));
    }

    public function marketplaceDetails($id)
    {
        $item = \App\Models\MarketplaceListing::with('user')->findOrFail($id);
        return view('pages.marketplace-details', compact('item'));
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
