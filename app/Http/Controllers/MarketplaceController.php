<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketplaceListing;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    public function create()
    {
        return view('pages.marketplace-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'condition' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('marketplace', 'public');
        }

        MarketplaceListing::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'condition' => $request->condition,
            'price' => $request->price,
            'location' => $request->location,
            'description' => $request->description,
            'image_path' => $imagePath,
            'status' => 'Active'
        ]);

        return redirect()->route('marketplace.index')->with('success', 'Your listing has been published!');
    }

    public function edit($id)
    {
        $listing = MarketplaceListing::where('user_id', Auth::id())->findOrFail($id);
        return view('pages.marketplace-edit', compact('listing'));
    }

    public function update(Request $request, $id)
    {
        $listing = MarketplaceListing::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'condition' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('marketplace', 'public');
            $listing->image_path = $imagePath;
        }

        $listing->update([
            'title' => $request->title,
            'category' => $request->category,
            'condition' => $request->condition,
            'price' => $request->price,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Listing updated successfully!');
    }

    public function destroy($id)
    {
        $listing = MarketplaceListing::where('user_id', Auth::id())->findOrFail($id);
        $listing->delete();

        return redirect()->route('dashboard')->with('success', 'Listing deleted successfully!');
    }
}
