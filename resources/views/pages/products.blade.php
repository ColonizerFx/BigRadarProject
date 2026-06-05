@extends('layouts.front')

@section('title', 'Official Price Comparison - BigRadar')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="flex flex-col md:flex-row gap-8">
        
        <!-- Left Sidebar Filter (eBay Style) -->
        <div class="w-full md:w-64 flex-shrink-0">
            <h3 class="font-bold text-lg text-gray-900 mb-4">Shop by Category</h3>
            <ul class="space-y-2 text-sm text-gray-700 mb-8">
                <li><a href="#" class="hover:underline font-medium">All PC Parts</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Processors (CPUs)</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Graphics Cards (GPUs)</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Motherboards</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Memory (RAM)</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Storage</a></li>
                <li><a href="#" class="hover:underline text-gray-500 pl-4">Power Supplies</a></li>
            </ul>

            <h3 class="font-bold text-gray-900 mb-3 border-t border-gray-200 pt-4">Condition</h3>
            <ul class="space-y-2 text-sm text-gray-700 mb-8">
                <li>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked disabled>
                        <span class="ml-2">New (Official Retailers)</span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center text-gray-400">
                        <input type="checkbox" class="rounded border-gray-300" disabled>
                        <span class="ml-2">Used (See Marketplace)</span>
                    </label>
                </li>
            </ul>

            <h3 class="font-bold text-gray-900 mb-3 border-t border-gray-200 pt-4">Compare Retailers</h3>
            <ul class="space-y-2 text-sm text-gray-700 mb-8">
                <li>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">TMT</span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">All IT Hypermarket</span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">Harvey Norman</span>
                    </label>
                </li>
            </ul>
        </div>

        <!-- Main Product Grid -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Compare Official PC Parts</h1>
                <div class="flex items-center text-sm">
                    <span class="mr-2 text-gray-500">Sort:</span>
                    <select class="border-gray-300 rounded-md py-1 pl-3 pr-8 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option>Best Match</option>
                        <option>Price: lowest first</option>
                        <option>Price: highest first</option>
                        <option>Newly listed</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <!-- Product Card -->
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden group hover:shadow-lg transition-shadow">
                        <div class="h-48 bg-gray-50 flex items-center justify-center p-4 relative">
                            <img src="{{ $product->image_path ? asset('storage/'.$product->image_path) : 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" alt="{{ $product->name }}" class="h-full object-contain group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4 border-t border-gray-100 flex flex-col h-[200px]">
                            <h4 class="font-medium text-gray-900 text-sm line-clamp-2 mb-2 group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('products.details', $product->id) }}"><span class="absolute inset-0"></span>{{ $product->name }}</a>
                            </h4>
                            <div class="text-xs text-gray-500 mb-2">{{ $product->brand }} &middot; {{ $product->category }}</div>
                            
                            <div class="mt-auto">
                                @php
                                    $minPrice = $product->retailers->min('pivot.price');
                                    $retailerCount = $product->retailers->count();
                                @endphp
                                
                                @if($retailerCount > 0)
                                    <div class="text-xl font-bold text-gray-900">RM {{ number_format($minPrice, 2) }}</div>
                                    <div class="text-xs text-gray-500 mt-1 line-through">RM {{ number_format($minPrice * 1.1, 2) }}</div>
                                    <div class="text-xs text-green-600 mt-2 font-medium">{{ $retailerCount }} store(s) compared</div>
                                @else
                                    <div class="text-sm font-medium text-gray-400">Price unavailable</div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">No products available</h3>
                        <p class="mt-1 text-gray-500">We are currently restocking our database. Check back soon.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
