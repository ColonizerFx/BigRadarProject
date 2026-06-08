@extends('layouts.front')

@section('title', 'User Marketplace - BigRadar')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-4 animate-fade-in-up">
        <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900 font-medium">User Marketplace (C2C)</span>
    </nav>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-6 animate-fade-in-up">
            {{ session('success') }}
        </div>
    @endif

    {{-- Page Title + Sell Button --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 animate-fade-in-up">
        <h1 class="text-3xl font-black text-gray-900">User Marketplace</h1>
        @auth
            <a href="{{ route('marketplace.create') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-bold py-3 px-8 rounded-full hover-lift shadow-md transition-all text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Sell an Item
            </a>
        @else
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-bold py-3 px-8 rounded-full hover-lift shadow-md transition-all text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Sell an Item
            </a>
        @endauth
    </div>

    {{-- Horizontal Filter Bar --}}
    <form action="{{ url('/marketplace') }}" method="GET" id="marketplace-filter-form" class="animate-fade-in-up">
        <div class="flex flex-wrap items-center gap-3 mb-4">
            {{-- Filter Icon Button --}}
            <button type="submit" class="flex items-center gap-2 border border-gray-300 rounded-full px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Filter
            </button>

            {{-- Category Dropdown --}}
            <select name="category" onchange="document.getElementById('marketplace-filter-form').submit()" class="border border-gray-300 rounded-full px-4 py-2 text-sm text-gray-700 bg-white hover:border-gray-400 focus:ring-brand focus:border-brand transition-all cursor-pointer appearance-none pr-8">
                <option value="">Category</option>
                @foreach(['Graphics Card', 'Processor', 'Motherboard', 'Memory', 'Storage', 'Power Supply', 'Cooling & Fans'] as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            {{-- Condition Dropdown --}}
            <select name="condition[]" onchange="document.getElementById('marketplace-filter-form').submit()" class="border border-gray-300 rounded-full px-4 py-2 text-sm text-gray-700 bg-white hover:border-gray-400 focus:ring-brand focus:border-brand transition-all cursor-pointer appearance-none pr-8">
                <option value="">Condition</option>
                @foreach(['New (Open Box)', 'Used - Like New', 'Used - Good', 'Used - Fair'] as $condition)
                    <option value="{{ $condition }}" {{ in_array($condition, request('condition', [])) ? 'selected' : '' }}>{{ $condition }}</option>
                @endforeach
            </select>

            {{-- Location Dropdown --}}
            <select name="location[]" onchange="document.getElementById('marketplace-filter-form').submit()" class="border border-gray-300 rounded-full px-4 py-2 text-sm text-gray-700 bg-white hover:border-gray-400 focus:ring-brand focus:border-brand transition-all cursor-pointer appearance-none pr-8">
                <option value="">Location</option>
                @foreach(['Kuala Lumpur', 'Selangor', 'Penang', 'Johor', 'Sabah', 'Sarawak'] as $loc)
                    <option value="{{ $loc }}" {{ in_array($loc, request('location', [])) ? 'selected' : '' }}>{{ $loc }}</option>
                @endforeach
            </select>

            {{-- Spacer --}}
            <div class="flex-1"></div>

            {{-- Sort Dropdown (right-aligned) --}}
            <select name="sort" onchange="document.getElementById('marketplace-filter-form').submit()" class="border border-gray-300 rounded-full px-4 py-2 text-sm text-gray-700 bg-white hover:border-gray-400 focus:ring-brand focus:border-brand transition-all cursor-pointer appearance-none pr-8">
                <option value="">Default</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: lowest first</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: highest first</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newly listed</option>
            </select>
        </div>
    </form>

    {{-- Result Count --}}
    <div class="text-sm text-gray-500 mb-6 animate-fade-in-up">
        <span class="font-medium text-gray-900">{{ count($listings) }}</span> result{{ count($listings) !== 1 ? 's' : '' }}
    </div>

    {{-- Marketplace Card Grid --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($listings as $item)
            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden group hover-lift shadow-sm relative animate-fade-in-up">
                {{-- Condition Badge --}}
                <div class="absolute top-3 left-3 z-10 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-md shadow-sm">
                    {{ $item->condition }}
                </div>

                {{-- Product Image --}}
                <div class="h-52 bg-white flex items-center justify-center p-6">
                    @php
                        $imgSrc = match(true) {
                            !$item->image_path => null,
                            Str::startsWith($item->image_path, 'http') => $item->image_path,
                            Str::startsWith($item->image_path, 'assets/') => asset($item->image_path),
                            default => asset('storage/'.$item->image_path),
                        };
                    @endphp
                    <a href="{{ route('marketplace.details', $item->id) }}" class="h-full flex items-center justify-center">
                        <img src="{{ $imgSrc ?? asset('assets/images/placeholder-part.png') }}" alt="{{ $item->title }}" class="h-full object-contain group-hover:scale-105 transition-transform duration-300 mix-blend-multiply">
                    </a>
                </div>

                {{-- Item Info --}}
                <div class="px-5 pb-5 pt-3">
                    <h4 class="font-bold text-gray-900 text-sm line-clamp-2 mb-1 group-hover:text-brand transition-colors min-h-[2.5rem]">
                        <a href="{{ route('marketplace.details', $item->id) }}"><span class="absolute inset-0"></span>{{ $item->title }}</a>
                    </h4>
                    <div class="text-xs text-gray-400 mb-3">
                        by {{ $item->user->name }} · {{ $item->location }}
                    </div>

                    <div class="flex items-baseline gap-2 mb-4">
                        <span class="text-lg font-black text-gray-900">RM {{ number_format($item->price, 2) }}</span>
                    </div>

                    {{-- Action Buttons --}}
                    @auth
                        @if(Auth::id() !== $item->user_id)
                            <div class="space-y-2">
                                <form action="{{ route('cart.buyMarketplace', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-center bg-brand hover:bg-brand-dark text-white rounded-full py-2.5 text-sm font-bold transition-all flex justify-center items-center gap-2 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        Buy Now
                                    </button>
                                </form>
                                <form action="{{ route('chat.initiate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="listing_id" value="{{ $item->id }}">
                                    <button type="submit" class="w-full text-center border border-gray-300 rounded-full py-2.5 text-sm font-bold text-gray-800 hover:border-brand hover:text-brand hover:bg-gray-50 transition-all flex justify-center items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                        Chat with Seller
                                    </button>
                                </form>
                            </div>
                        @else
                            <button disabled class="w-full text-center border border-gray-200 bg-gray-50 rounded-full py-2.5 text-sm font-bold text-gray-400 cursor-not-allowed">
                                Your Listing
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="w-full inline-block text-center bg-brand hover:bg-brand-dark text-white rounded-full py-2.5 text-sm font-bold transition-all text-center">
                            Login to Buy
                        </a>
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <h3 class="text-lg font-bold text-gray-900">No listings yet</h3>
                <p class="mt-2 text-gray-500 text-sm">Be the first to sell something on the marketplace!</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
