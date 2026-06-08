@extends('layouts.front')

@section('title', 'Devices - BigRadar')

@section('content')

<!-- Header & Filters Area (White Background) -->
<div class="bg-white pt-8 pb-6 w-full border-b border-gray-100 shadow-sm relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 mb-4 animate-fade-in-up">
            <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">Devices</span>
        </nav>

        {{-- Page Title --}}
        <h1 class="text-[32px] font-bold text-gray-900 mb-6 tracking-tight animate-fade-in-up" style="font-family: 'Inter', sans-serif;">Devices</h1>

        {{-- Horizontal Filter Bar --}}
        <form action="{{ url('/devices') }}" method="GET" id="devices-filter-form" class="animate-fade-in-up">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <div class="flex flex-wrap items-center gap-3 mb-2">
                {{-- Filter Icon Button --}}
                <button type="submit" class="flex items-center gap-2 border border-gray-200 rounded-full px-4 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all shadow-sm bg-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>

                {{-- Device Type Dropdown --}}
                <select name="category" onchange="document.getElementById('devices-filter-form').submit()" class="border border-gray-200 rounded-full px-4 py-1.5 text-sm text-gray-700 bg-white hover:bg-gray-50 focus:ring-brand focus:border-brand transition-all cursor-pointer appearance-none pr-8 shadow-sm">
                    <option value="">All Devices</option>
                    @foreach(['Apple Devices', 'Monitor', 'Laptop', 'Tablet', 'Smartphone', 'Watch'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                {{-- Brand Dropdown --}}
                <select name="brand" onchange="document.getElementById('devices-filter-form').submit()" class="border border-gray-200 rounded-full px-4 py-1.5 text-sm text-gray-700 bg-white hover:bg-gray-50 focus:ring-brand focus:border-brand transition-all cursor-pointer appearance-none pr-8 shadow-sm">
                    <option value="">Brands</option>
                    @foreach(['Apple', 'Samsung', 'ASUS', 'Acer', 'Dell', 'LG', 'Sony'] as $brand)
                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>

                {{-- Reset Link --}}
                @if(request()->except('search'))
                    <a href="{{ url('/devices') }}" class="text-sm font-semibold text-red-500 hover:text-red-700 underline underline-offset-2 ml-2 transition-colors">Clear Filters</a>
                @endif

                {{-- Spacer --}}
                <div class="flex-1"></div>

                {{-- Sort Dropdown (right-aligned) --}}
                <select name="sort" onchange="document.getElementById('devices-filter-form').submit()" class="border border-gray-200 rounded-full px-4 py-1.5 text-sm text-gray-700 bg-white hover:bg-gray-50 focus:ring-brand focus:border-brand transition-all cursor-pointer appearance-none pr-8 shadow-sm">
                    <option value="">Sort: Default</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: lowest first</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: highest first</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newly listed</option>
                </select>
            </div>
        </form>
    </div>
</div>

<!-- Product Grid Area (Slate Background) -->
<div class="bg-gray-100 py-8 w-full min-h-screen shadow-inner">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Result Count --}}
        <div class="text-sm text-gray-500 mb-6 animate-fade-in-up">
            <span class="font-medium text-gray-900">{{ count($products) }}</span> result{{ count($products) !== 1 ? 's' : '' }}
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-5">
            @forelse($products as $product)
                @php
                    $minPrice = $product->retailers->min('pivot.price');
                    $maxPrice = $product->retailers->max('pivot.price');
                    $retailerCount = $product->retailers->count();
                    $discount = ($maxPrice && $maxPrice > $minPrice) ? round((1 - $minPrice / $maxPrice) * 100) : 0;
                @endphp

                <div class="bg-white rounded-xl overflow-hidden group hover:shadow-xl transition-all duration-300 shadow-md relative animate-fade-in-up flex flex-col border border-gray-100 hover:-translate-y-1">
                    {{-- Discount Badge --}}
                    @if($discount > 0)
                        <div class="absolute top-2 left-2 z-10 bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm">
                            {{ $discount }}% OFF
                        </div>
                    @endif

                    <div class="h-44 bg-[#F9FAFB] flex items-center justify-center p-6 relative">
                        @php
                            $imgSrc = match(true) {
                                !$product->image_path => null,
                                Str::startsWith($product->image_path, 'http') => $product->image_path,
                                Str::startsWith($product->image_path, 'assets/') => asset($product->image_path),
                                default => asset('storage/'.$product->image_path),
                            };
                        @endphp
                        <img src="{{ $imgSrc ?? asset('assets/images/placeholder-part.png') }}" alt="{{ $product->name }}" class="h-full object-contain group-hover:scale-105 transition-transform duration-300 mix-blend-multiply">
                    </div>

                    {{-- Product Info --}}
                    <div class="px-4 pb-4 pt-3 flex-1 flex flex-col">
                        <h4 class="font-semibold text-gray-900 text-[15px] leading-snug line-clamp-2 mb-2 min-h-[2.5rem]">
                            <a href="{{ route('products.details', $product->id) }}"><span class="absolute inset-0"></span>{{ $product->name }}</a>
                        </h4>

                        <div class="mt-auto">
                            @if($retailerCount > 0)
                                <div class="flex flex-col mb-1">
                                    <span class="text-lg font-bold text-gray-900">RM {{ number_format($minPrice, 2) }}</span>
                                    @if($maxPrice > $minPrice)
                                        <span class="text-sm text-gray-400 line-through font-medium">RM {{ number_format($maxPrice, 2) }}</span>
                                    @endif
                                </div>
                            @else
                                <div class="text-sm font-medium text-gray-400 mb-2">Price unavailable</div>
                            @endif

                            {{-- Buy Now Button --}}
                            <a href="{{ route('products.details', $product->id) }}" class="mt-3 block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-900 font-semibold py-2 rounded-lg transition-colors text-sm relative z-10">
                                Buy Now
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-lg shadow-sm">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <h3 class="text-lg font-bold text-gray-900">No devices found</h3>
                    <p class="mt-2 text-gray-500 text-sm">Try adjusting your filters or check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
