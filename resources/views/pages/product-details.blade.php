@extends('layouts.front')

@section('title', $product->name . ' - Price Comparison')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white py-8">
    
    <!-- Breadcrumb -->
    <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
            <li><span>&rsaquo;</span></li>
            <li><a href="{{ url('/products') }}" class="hover:underline">PC Parts</a></li>
            <li><span>&rsaquo;</span></li>
            <li><a href="#" class="hover:underline">{{ $product->category }}</a></li>
            <li><span>&rsaquo;</span></li>
            <li aria-current="page" class="text-gray-900 font-medium">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Product Info Section (eBay Style) -->
    <div class="lg:flex lg:gap-8 mb-12">
        <!-- Image -->
        <div class="lg:w-2/5 border border-gray-200 rounded-lg p-4 flex items-center justify-center bg-white min-h-[400px]">
            <img src="{{ $product->image_path ? asset('storage/'.$product->image_path) : 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $product->name }}" class="object-contain w-full max-h-[350px]">
        </div>

        <!-- Details -->
        <div class="lg:w-3/5 mt-6 lg:mt-0">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
            
            <div class="flex items-center space-x-4 mb-4 text-sm">
                <div class="flex text-yellow-400">
                    &#9733;&#9733;&#9733;&#9733;&#9734; <span class="text-gray-500 ml-1">(24 product ratings)</span>
                </div>
                <div class="text-gray-500">|</div>
                <div class="text-gray-500">Brand: <span class="font-bold text-gray-900">{{ $product->brand }}</span></div>
                @auth
                <div class="text-gray-500">|</div>
                <form action="{{ route('wishlist.toggle') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @php
                        $isWishlisted = \App\Models\Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
                    @endphp
                    <button type="submit" class="flex items-center gap-1 {{ $isWishlisted ? 'text-red-500' : 'text-gray-500 hover:text-red-500' }} transition-colors">
                        <svg class="w-4 h-4" fill="{{ $isWishlisted ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        {{ $isWishlisted ? 'Wishlisted' : 'Add to Wishlist' }}
                    </button>
                </form>
                @endauth
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded mb-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-6">
                @php
                    $minPrice = $product->retailers->min('pivot.price');
                    $retailerCount = $product->retailers->count();
                @endphp
                
                <div class="text-gray-500 text-sm mb-1">Lowest Official Price:</div>
                <div class="text-3xl font-bold text-gray-900 mb-4">RM {{ number_format($minPrice, 2) }}</div>
                
                <div class="text-sm mb-4">
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded font-medium">{{ $retailerCount }} retailers</span> currently stocking this item.
                </div>
                
                <a href="#compare-table" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-full transition-colors">
                    Compare All Prices
                </a>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-gray-900 font-bold mb-2">Item specifics</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="flex"><span class="text-gray-500 w-24">Condition:</span><span class="font-medium text-gray-900">Brand New</span></div>
                    <div class="flex"><span class="text-gray-500 w-24">Category:</span><span class="font-medium text-gray-900">{{ $product->category }}</span></div>
                    <div class="flex"><span class="text-gray-500 w-24">Warranty:</span><span class="font-medium text-gray-900">Manufacturer Warranty</span></div>
                    <div class="flex"><span class="text-gray-500 w-24">Shipping:</span><span class="font-medium text-gray-900">Calculated at checkout</span></div>
                </div>
            </div>
            
            <div class="mt-6">
                <h3 class="text-gray-900 font-bold mb-2">Description</h3>
                <p class="text-sm text-gray-700">{{ $product->description }}</p>
            </div>
        </div>
    </div>

    <!-- Price Comparison Table -->
    <div id="compare-table" class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b-2 border-gray-900 pb-2 inline-block">Official Retailer Prices</h2>
        
        <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Retailer</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Availability</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total Price</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($product->retailers->sortBy('pivot.price') as $retailer)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-6 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="font-bold text-gray-900 text-lg">{{ $retailer->name }}</div>
                            </div>
                            <a href="{{ $retailer->website_url }}" target="_blank" class="text-xs text-blue-600 hover:underline">Visit Store Front</a>
                        </td>
                        <td class="px-6 py-6 whitespace-nowrap">
                            @if($retailer->pivot->availability_status == 'In Stock')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800">
                                    {{ $retailer->pivot->availability_status }}
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800">
                                    {{ $retailer->pivot->availability_status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-6 whitespace-nowrap">
                            <div class="text-xl font-bold text-gray-900">RM {{ number_format($retailer->pivot->price, 2) }}</div>
                            <div class="text-xs text-gray-500">+ Shipping</div>
                        </td>
                        <td class="px-6 py-6 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                @auth
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="retailer_id" value="{{ $retailer->id }}">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full inline-block transition-colors shadow-sm">
                                        Add to Cart
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full inline-block transition-colors shadow-sm">
                                    Add to Cart
                                </a>
                                @endauth
                                <a href="{{ $retailer->pivot->product_url }}" target="_blank" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-bold py-2 px-4 rounded-full inline-block transition-colors text-xs">
                                    Buy Direct
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
