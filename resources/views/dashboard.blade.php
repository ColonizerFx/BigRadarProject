@extends('layouts.front')

@section('title', 'My Dashboard - BigRadar')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 space-y-8">
    
    <div class="flex justify-between items-center bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
            <p class="text-sm text-gray-500">Welcome back, {{ Auth::user()->name }}</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium hover:underline">
                Log Out
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Orders -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Transaction History</h3>
                </div>
                <div class="p-6">
                    @php
                        $orders = \App\Models\Order::where('user_id', Auth::id())->with('items.product')->latest()->get();
                    @endphp
                    
                    @if($orders->count() > 0)
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="border border-gray-200 rounded-md p-4">
                                    <div class="flex justify-between items-center mb-2 pb-2 border-b border-gray-100">
                                        <div class="text-sm font-bold text-gray-800">Order #{{ $order->id }}</div>
                                        <div class="text-xs text-gray-500">{{ $order->created_at->format('d M Y') }}</div>
                                    </div>
                                    <ul class="text-sm text-gray-700 space-y-1">
                                        @foreach($order->items as $item)
                                            <li>{{ $item->quantity }}x {{ $item->product->name ?? 'Product Deleted' }}</li>
                                        @endforeach
                                    </ul>
                                    <div class="mt-3 text-right font-bold text-gray-900 flex justify-between items-center">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                            {{ $order->status }}
                                        </span>
                                        <span>RM {{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">You have no past orders.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Wishlist -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">My Wishlist</h3>
                </div>
                <div class="p-6">
                    @php
                        $wishlisted = \App\Models\Wishlist::where('user_id', Auth::id())->with('product.retailers')->latest()->get();
                    @endphp
                    
                    @if($wishlisted->count() > 0)
                        <div class="space-y-4">
                            @foreach($wishlisted as $wish)
                                @if($wish->product)
                                <div class="border border-gray-200 rounded-md p-4 flex items-center gap-4">
                                    <div class="w-16 h-16 bg-gray-50 rounded flex items-center justify-center flex-shrink-0 border border-gray-100">
                                        <img src="{{ $wish->product->image_path ? asset('storage/'.$wish->product->image_path) : 'https://images.unsplash.com/photo-1591488320449-011701bb6704?w=100' }}" class="h-full object-contain mix-blend-multiply">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('products.details', $wish->product->id) }}" class="text-sm font-bold text-gray-900 hover:text-blue-600 truncate block">{{ $wish->product->name }}</a>
                                        @php $wprice = $wish->product->retailers->min('pivot.price'); @endphp
                                        @if($wprice)
                                            <div class="text-sm font-bold text-green-700 mt-1">RM {{ number_format($wprice, 2) }}</div>
                                        @endif
                                    </div>
                                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $wish->product->id }}">
                                        <button type="submit" class="text-red-400 hover:text-red-600 p-1" title="Remove">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Your wishlist is empty.</p>
                            <a href="{{ route('products') }}" class="text-sm text-blue-600 hover:underline mt-2 inline-block font-medium">Browse products</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Marketplace Listings -->
        <div class="lg:col-span-2">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">My Marketplace Listings</h3>
                    <a href="{{ route('marketplace.create') }}" class="text-sm bg-blue-600 text-white font-medium px-4 py-2 rounded-md hover:bg-blue-700 transition-colors shadow-sm">
                        Sell New Item
                    </a>
                </div>
                <div class="p-6">
                    @php
                        $listings = \App\Models\MarketplaceListing::where('user_id', Auth::id())->latest()->get();
                    @endphp

                    @if($listings->count() > 0)
                        <div class="space-y-4">
                            @foreach($listings as $listing)
                                <div class="border border-gray-200 rounded-md p-4 flex flex-col sm:flex-row gap-4 items-center overflow-hidden">
                                    <div class="w-24 h-24 bg-gray-50 flex items-center justify-center rounded overflow-hidden flex-shrink-0 border border-gray-100">
                                        <img src="{{ $listing->image_path ? asset('storage/'.$listing->image_path) : 'https://images.unsplash.com/photo-1587202372616-b43abea06c2a' }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 text-center sm:text-left">
                                        <h4 class="font-bold text-gray-900">{{ $listing->title }}</h4>
                                        <div class="text-xs text-gray-500 mt-1">{{ $listing->category }} &middot; {{ $listing->condition }}</div>
                                        <div class="text-sm font-bold text-blue-600 mt-1">RM {{ number_format($listing->price, 2) }}</div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <svg class="w-3 h-3 inline text-gray-400 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                            {{ $listing->location }}
                                        </div>
                                    </div>
                                    <div class="flex flex-row sm:flex-col gap-2 w-full sm:w-auto mt-4 sm:mt-0">
                                        <a href="{{ route('marketplace.edit', $listing->id) }}" class="flex-1 sm:flex-none text-center bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-1.5 px-4 rounded text-sm transition-colors">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('marketplace.destroy', $listing->id) }}" class="flex-1 sm:flex-none" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-center bg-white border border-red-200 text-red-600 hover:bg-red-50 font-medium py-1.5 px-4 rounded text-sm transition-colors">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            <h3 class="text-sm font-medium text-gray-900">No active listings</h3>
                            <p class="mt-1 text-sm text-gray-500">You haven't listed anything for sale yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
