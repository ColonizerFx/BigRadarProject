@extends('layouts.front')

@section('title', 'My Dashboard - RigRadar')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-500 mt-1">Welcome back, {{ Auth::user()->name ?? Auth::user()->first_name }}</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-red-500 font-bold hover:text-red-700">
                Log Out
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-8">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Left Column: Transaction History -->
        <div class="w-full lg:w-1/3">
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 h-full">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Transaction History</h3>
                
                @php
                    $orders = \App\Models\Order::where('user_id', Auth::id())->with('items.product')->latest()->get();
                @endphp
                
                @if($orders->count() > 0)
                    <div class="space-y-4">
                        @foreach($orders as $order)
                            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                                <div class="flex justify-between items-center mb-4">
                                    <div class="text-sm font-bold text-gray-900">Order #{{ $order->id }}</div>
                                    <div class="text-xs text-gray-400">{{ $order->created_at->format('d M Y') }}</div>
                                </div>
                                <div class="space-y-2 mb-6">
                                    @foreach($order->items as $item)
                                        @php
                                            $orderImg = null;
                                            if ($item->product) {
                                                $p = $item->product->image_path;
                                                $orderImg = match(true) {
                                                    empty($p)                          => null,
                                                    Str::startsWith($p, 'http')        => $p,
                                                    Str::startsWith($p, 'assets/')     => asset($p),
                                                    default                            => asset('storage/' . $p),
                                                };
                                            }
                                        @endphp
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center flex-shrink-0">
                                                <img src="{{ $orderImg ?? asset('assets/images/placeholder-part.png') }}" class="w-full h-full object-contain mix-blend-multiply rounded" alt="">
                                            </div>
                                            <div class="text-sm text-gray-600 truncate min-w-0">{{ $item->quantity }}x {{ $item->product->name ?? 'Product Deleted' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="flex justify-between items-end">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-bold
                                        {{ $order->status === 'Cancelled' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-700' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <span class="font-bold text-gray-900">RM {{ number_format($order->total_amount, 2) }}</span>
                                </div>
                                @if($order->status !== 'Cancelled')
                                <form method="POST" action="{{ route('orders.cancel', $order->id) }}" onsubmit="return confirm('Cancel Order #{{ $order->id }}?')" class="mt-3">
                                    @csrf
                                    <button type="submit" class="w-full text-xs font-semibold text-red-500 border border-red-200 rounded-lg py-1.5 hover:bg-red-50 transition-colors">
                                        Cancel Order
                                    </button>
                                </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl border border-gray-100 p-8 text-center">
                        <p class="text-sm text-gray-500">You have no past orders.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Marketplace & Wishlist -->
        <div class="w-full lg:w-2/3 space-y-8">
            
            <!-- Marketplace Listings -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900">My Marketplace Listings</h3>
                    <a href="{{ route('marketplace.create') }}" class="text-sm bg-blue-600 text-white font-bold px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Sell New Item
                    </a>
                </div>
                
                @php
                    $listings = \App\Models\MarketplaceListing::where('user_id', Auth::id())->latest()->get();
                @endphp

                @if($listings->count() > 0)
                    <div class="bg-white rounded-xl border border-gray-200 p-4">
                        <div class="space-y-4">
                            @foreach($listings as $listing)
                                @php
                                    $listingImg = match(true) {
                                        empty($listing->image_path)                          => null,
                                        Str::startsWith($listing->image_path, 'http')        => $listing->image_path,
                                        Str::startsWith($listing->image_path, 'assets/')     => asset($listing->image_path),
                                        default                                              => asset('storage/' . $listing->image_path),
                                    };
                                @endphp
                                <div class="flex flex-col sm:flex-row gap-4 items-center border border-gray-200 rounded-lg p-3 relative">
                                    <div class="w-20 h-20 bg-gray-100 flex items-center justify-center rounded flex-shrink-0">
                                        <img src="{{ $listingImg ?? asset('assets/images/placeholder-part.png') }}" class="w-full h-full object-cover rounded">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900">{{ $listing->title }}</h4>
                                        <div class="text-xs text-gray-500 mt-1">{{ $listing->category }} - {{ $listing->condition }}</div>
                                        <div class="text-sm font-bold text-blue-600 mt-1">RM {{ number_format($listing->price, 2) }}</div>
                                        <div class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                            {{ $listing->location }}
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <a href="{{ route('marketplace.edit', $listing->id) }}" class="text-center bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-bold py-1.5 px-6 rounded-md text-xs transition-colors">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('marketplace.destroy', $listing->id) }}" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-center bg-white border border-red-100 text-red-500 hover:bg-red-50 font-bold py-1.5 px-6 rounded-md text-xs transition-colors">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-xl border border-gray-100 p-8 text-center">
                        <p class="text-sm text-gray-500">You haven't listed anything for sale yet.</p>
                    </div>
                @endif
            </div>

            <!-- Wishlist -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">My Wishlist</h3>
                
                @php
                    $wishlisted = \App\Models\Wishlist::where('user_id', Auth::id())->with('product.retailers')->latest()->get();
                @endphp
                
                @if($wishlisted->count() > 0)
                    <div class="bg-white rounded-xl border border-gray-200 p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($wishlisted as $wish)
                                @if($wish->product)
                                @php
                                    $wishImg = match(true) {
                                        empty($wish->product->image_path)                          => null,
                                        Str::startsWith($wish->product->image_path, 'http')        => $wish->product->image_path,
                                        Str::startsWith($wish->product->image_path, 'assets/')     => asset($wish->product->image_path),
                                        default                                                    => asset('storage/' . $wish->product->image_path),
                                    };
                                @endphp
                                <div class="border border-gray-200 rounded-lg p-3 flex items-center gap-4 relative">
                                    <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center flex-shrink-0">
                                        <img src="{{ $wishImg ?? asset('assets/images/placeholder-part.png') }}" class="h-12 object-contain mix-blend-multiply">
                                    </div>
                                    <div class="flex-1 min-w-0 pr-8">
                                        <a href="{{ route('products.details', $wish->product->id) }}" class="text-xs font-bold text-gray-900 hover:text-blue-600 truncate block">{{ $wish->product->name }}</a>
                                        @php $wprice = $wish->product->retailers->min('pivot.price'); @endphp
                                        @if($wprice)
                                            <div class="text-sm font-bold text-green-700 mt-2">RM {{ number_format($wprice, 2) }}</div>
                                        @endif
                                    </div>
                                    <form action="{{ route('wishlist.toggle') }}" method="POST" class="absolute top-3 right-3">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $wish->product->id }}">
                                        <button type="submit" class="text-red-400 hover:text-red-600" title="Remove">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-xl border border-gray-100 p-8 text-center">
                        <p class="text-sm text-gray-500">Your wishlist is empty.</p>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</div>
@endsection
