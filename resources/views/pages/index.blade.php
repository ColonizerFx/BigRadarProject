@extends('layouts.front')

@section('title', 'BigRadar - PC Parts Price Comparison')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Hero / Main Banner Area -->
    <div class="bg-blue-600 rounded-lg overflow-hidden flex flex-col md:flex-row relative mb-12">
        <div class="p-8 md:p-12 md:w-1/2 z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Build Your Dream PC</h2>
            <p class="text-blue-100 text-lg mb-6">Compare prices from top Malaysian retailers instantly. Find the best deals on RTX 40-series and Ryzen 7000 processors.</p>
            <a href="{{ url('/products') }}" class="inline-block bg-white text-blue-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition-colors">Compare Prices Now &rarr;</a>
        </div>
        <div class="md:w-1/2 relative bg-blue-800 hidden md:block">
            <!-- Decorative circle -->
            <div class="absolute w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 top-0 -right-20"></div>
        </div>
    </div>

    <!-- Official Retailer Price Drops (The Products) -->
    <div class="mb-12">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Official Retailer Parts</h3>
                <p class="text-gray-500 text-sm mt-1">Compare prices from TMT, All IT, and Harvey Norman</p>
            </div>
            <a href="{{ url('/products') }}" class="text-blue-600 hover:underline text-sm font-medium">See all <span aria-hidden="true">&rarr;</span></a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @forelse($featuredProducts as $product)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden group hover:shadow-lg transition-shadow">
                    <div class="h-48 bg-gray-50 flex items-center justify-center p-4">
                        <img src="{{ $product->image_path ? asset('storage/'.$product->image_path) : 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" alt="{{ $product->name }}" class="h-full object-contain group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-4 border-t border-gray-100">
                        <h4 class="font-medium text-gray-900 text-sm line-clamp-2 mb-2 group-hover:text-blue-600 transition-colors">
                            <a href="{{ route('products.details', $product->id) }}"><span class="absolute inset-0"></span>{{ $product->name }}</a>
                        </h4>
                        <div class="text-xs text-gray-500 mb-2">{{ $product->brand }} &middot; {{ $product->category }}</div>
                        
                        @php
                            $minPrice = $product->retailers->min('pivot.price');
                            $retailerCount = $product->retailers->count();
                        @endphp
                        
                        @if($retailerCount > 0)
                            <div class="text-lg font-bold text-gray-900">From RM {{ number_format($minPrice, 2) }}</div>
                            <div class="text-xs text-green-600 mt-1">{{ $retailerCount }} store(s) compared</div>
                        @else
                            <div class="text-sm font-medium text-gray-400">Price unavailable</div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">No official products available.</div>
            @endforelse
        </div>
    </div>

    <!-- User Marketplace Items -->
    <div class="mb-12 border-t border-gray-200 pt-12">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">User Marketplace</h3>
                <p class="text-gray-500 text-sm mt-1">Buy used and open-box parts from fellow PC enthusiasts</p>
            </div>
            <a href="{{ url('/marketplace') }}" class="text-blue-600 hover:underline text-sm font-medium">See all <span aria-hidden="true">&rarr;</span></a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @forelse($marketplaceItems as $item)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden group hover:shadow-lg transition-shadow">
                    <div class="h-40 bg-gray-50 flex items-center justify-center p-4 relative">
                        <img src="{{ $item->image_path ? asset('storage/'.$item->image_path) : 'https://images.unsplash.com/photo-1587202372616-b43abea06c2a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" alt="{{ $item->title }}" class="h-full object-contain">
                        <div class="absolute top-2 left-2 bg-gray-800 text-white text-[10px] uppercase px-2 py-0.5 rounded-sm font-semibold">
                            {{ $item->condition }}
                        </div>
                    </div>
                    <div class="p-4 border-t border-gray-100">
                        <h4 class="font-medium text-gray-900 text-sm line-clamp-2 mb-1 group-hover:underline">
                            <a href="#">{{ $item->title }}</a>
                        </h4>
                        <div class="text-lg font-bold text-gray-900 mb-1">RM {{ number_format($item->price, 2) }}</div>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $item->location }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">No marketplace listings available.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
