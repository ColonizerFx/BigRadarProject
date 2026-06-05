@extends('layouts.front')

@section('title', 'User Marketplace - BigRadar')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-yellow-800">BigRadar User Marketplace</h2>
            <p class="text-yellow-700 text-sm mt-1">Buy and sell used PC parts directly with other enthusiasts. No middleman, no extra fees.</p>
        </div>
        <button onclick="alert('Demo: Listing creation feature coming soon!')" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded-md transition-colors text-sm shadow-sm">
            Sell an Item
        </button>
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        
        <!-- Left Sidebar Filter (eBay Style) -->
        <div class="w-full md:w-64 flex-shrink-0">
            <h3 class="font-bold text-lg text-gray-900 mb-4">Shop by Category</h3>
            <ul class="space-y-2 text-sm text-gray-700 mb-8">
                <li><a href="#" class="hover:underline font-medium">All Parts</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Graphics Cards</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Processors</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Power Supplies</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Cooling & Fans</a></li>
            </ul>

            <h3 class="font-bold text-gray-900 mb-3 border-t border-gray-200 pt-4">Condition</h3>
            <ul class="space-y-2 text-sm text-gray-700 mb-8">
                <li>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">New (Open Box)</span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                        <span class="ml-2">Used</span>
                    </label>
                </li>
            </ul>

            <h3 class="font-bold text-gray-900 mb-3 border-t border-gray-200 pt-4">Location</h3>
            <ul class="space-y-2 text-sm text-gray-700 mb-8">
                <li>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">Kuala Lumpur</span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">Selangor</span>
                    </label>
                </li>
            </ul>
        </div>

        <!-- Main Listing Grid -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
                <h1 class="text-2xl font-bold text-gray-900">{{ count($listings) }} Listings found</h1>
                <div class="flex items-center text-sm">
                    <span class="mr-2 text-gray-500">Sort:</span>
                    <select class="border-gray-300 rounded-md py-1 pl-3 pr-8 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option>Time: newly listed</option>
                        <option>Price: lowest first</option>
                        <option>Price: highest first</option>
                        <option>Distance: nearest first</option>
                    </select>
                </div>
            </div>

            <!-- List View (eBay Style rows) -->
            <div class="space-y-4">
                @forelse($listings as $item)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 flex flex-col sm:flex-row gap-6 hover:shadow-md transition-shadow group">
                        
                        <!-- Image -->
                        <div class="w-full sm:w-48 h-48 bg-gray-50 rounded flex items-center justify-center relative flex-shrink-0">
                            <img src="{{ $item->image_path ? asset('storage/'.$item->image_path) : 'https://images.unsplash.com/photo-1587202372616-b43abea06c2a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" alt="{{ $item->title }}" class="h-full object-contain mix-blend-multiply">
                            <div class="absolute top-2 left-2 bg-gray-800 text-white text-[10px] uppercase px-2 py-0.5 rounded-sm font-semibold shadow-sm">
                                {{ $item->condition }}
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 group-hover:underline transition-colors">
                                    <a href="#">{{ $item->title }}</a>
                                </h3>
                                <button class="text-gray-400 hover:text-red-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </button>
                            </div>
                            
                            <div class="text-xs text-gray-500 mb-3">{{ $item->category }} &middot; Posted by <span class="font-semibold text-blue-600">{{ $item->user->name }}</span></div>
                            
                            <div class="text-sm text-gray-700 line-clamp-2 mb-4">{{ $item->description }}</div>
                            
                            <div class="mt-auto flex justify-between items-end">
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">RM {{ number_format($item->price, 2) }}</div>
                                    <div class="text-xs text-gray-500 mt-1">Free pickup</div>
                                </div>
                                <div class="text-right">
                                    <div class="flex items-center text-sm font-medium text-gray-700 mb-1 justify-end">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $item->location }}
                                    </div>
                                    <button class="bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 font-bold py-1.5 px-4 rounded-full text-sm transition-colors">
                                        Contact Seller
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center text-gray-500 bg-white border border-gray-200 rounded-lg">
                        <p>No listings match your current filters.</p>
                    </div>
                @endforelse
            </div>
            
        </div>
    </div>
</div>
@endsection
