@extends('layouts.front')

@section('title', $product->name . ' - RigRadar')

@section('content')

@php
    $retailerGeoData = $product->retailers->map(function($r) {
        return [
            'id'           => $r->id,
            'name'         => $r->name,
            'location'     => $r->location,
            'lat'          => $r->latitude,
            'lng'          => $r->longitude,
            'price'        => $r->pivot->price,
            'availability' => $r->pivot->availability_status,
            'product_url'  => $r->pivot->product_url,
            'website_url'  => $r->website_url,
        ];
    });
@endphp

{{-- Pass retailer data to JS --}}
<script>
    const retailerGeoData = @json($retailerGeoData);
</script>

<!-- Top Section (White Background) -->
<div class="bg-white py-8 w-full border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
            <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
            <span>/</span>
            <a href="{{ url('/products') }}" class="hover:text-brand transition-colors">Find your Parts</a>
            <span>/</span>
            <a href="{{ url('/products?category='.urlencode($product->category)) }}" class="hover:text-brand transition-colors">{{ $product->category }}</a>
            <span>/</span>
            <span class="text-gray-900 font-medium truncate">{{ $product->name }}</span>
        </nav>

        {{-- Product Info Section --}}
        <div class="lg:flex lg:gap-10">
            
            {{-- Image --}}
            <div class="lg:w-2/5 bg-[#F9FAFB] rounded-lg p-8 flex items-center justify-center min-h-[380px] mb-6 lg:mb-0">
                @php
                    $detailImgSrc = match(true) {
                        !$product->image_path => null,
                        Str::startsWith($product->image_path, 'http') => $product->image_path,
                        Str::startsWith($product->image_path, 'assets/') => asset($product->image_path),
                        default => asset('storage/'.$product->image_path),
                    };
                @endphp
                <img src="{{ $detailImgSrc }}"
                     alt="{{ $product->name }}"
                     class="object-contain w-full max-h-[340px] mix-blend-multiply">
            </div>

            {{-- Details --}}
            <div class="lg:w-3/5">
                <div class="text-xs font-bold text-brand uppercase tracking-widest mb-2">{{ $product->brand }} · {{ $product->category }}</div>
                <h1 class="text-[32px] font-bold text-gray-900 mb-3 leading-snug tracking-tight" style="font-family: 'Inter', sans-serif;">{{ $product->name }}</h1>

                <div class="flex items-center gap-3 mb-5 text-sm">
                    <div class="flex text-yellow-400 text-base">&#9733;&#9733;&#9733;&#9733;&#9734;</div>
                    <span class="text-gray-400 font-medium">(24 ratings)</span>
                    @auth
                    <span class="text-gray-300">|</span>
                    <form action="{{ route('wishlist.toggle') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @php $isWishlisted = \App\Models\Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists(); @endphp
                        <button type="submit" class="flex items-center gap-1.5 {{ $isWishlisted ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }} transition-colors font-medium">
                            <svg class="w-4 h-4" fill="{{ $isWishlisted ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            {{ $isWishlisted ? 'Wishlisted' : 'Add to Wishlist' }}
                        </button>
                    </form>
                    @endauth
                </div>

                @if(session('success'))
                    <div class="bg-blue-50 text-brand px-4 py-3 rounded-lg mb-4 text-sm font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Price Summary Box --}}
                @php $minPrice = $product->retailers->min('pivot.price'); $retailerCount = $product->retailers->count(); @endphp
                <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6 shadow-sm">
                    <div class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-1">Lowest Official Price</div>
                    <div class="text-[32px] font-bold text-gray-900 mb-3" style="font-family: 'Inter', sans-serif;">RM {{ number_format($minPrice, 2) }}</div>
                    <div class="text-sm text-gray-500 mb-5">
                        <span class="inline-flex items-center gap-1.5 bg-gray-50 border border-gray-200 text-gray-700 font-bold px-3 py-1 rounded-full text-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            {{ $retailerCount }} retailer{{ $retailerCount > 1 ? 's' : '' }} stocking this
                        </span>
                    </div>
                    <a href="#store-locator" class="block w-full text-center bg-brand hover:bg-brand-dark text-white font-bold py-3 rounded-lg transition-colors text-sm">
                        📍 Find Nearest Store
                    </a>
                </div>

                {{-- Item Specs --}}
                <div class="border-t border-gray-100 pt-5 mb-5">
                    <h3 class="font-bold text-gray-900 mb-3 text-sm">Item Specifics</h3>
                    <div class="grid grid-cols-2 gap-y-3 gap-x-6 text-sm">
                        <div class="flex"><span class="text-gray-400 w-24 flex-shrink-0">Condition:</span><span class="font-semibold text-gray-900">Brand New</span></div>
                        <div class="flex"><span class="text-gray-400 w-24 flex-shrink-0">Category:</span><span class="font-semibold text-gray-900">{{ $product->category }}</span></div>
                        <div class="flex"><span class="text-gray-400 w-24 flex-shrink-0">Warranty:</span><span class="font-semibold text-gray-900">Manufacturer</span></div>
                        <div class="flex"><span class="text-gray-400 w-24 flex-shrink-0">Brand:</span><span class="font-semibold text-gray-900">{{ $product->brand }}</span></div>
                    </div>
                </div>

                @if($product->description)
                <div class="border-t border-gray-100 pt-5">
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">Description</h3>
                    <p class="text-[15px] text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- GEOLOCATION STORE LOCATOR SECTION (Slate Background) -->
<div id="store-locator" class="bg-[#F8FAFC] py-16 w-full min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h2 class="text-[28px] font-bold text-gray-900 tracking-tight" style="font-family: 'Inter', sans-serif;">📍 Find Nearest Stores</h2>
                <p class="text-gray-500 text-sm mt-1">Stores sorted by distance from your location</p>
            </div>

            {{-- Geolocation Trigger --}}
            <div id="geo-status" class="flex items-center gap-3">
                <button id="locate-btn" onclick="requestLocation()"
                    class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-bold px-5 py-2.5 rounded-lg text-sm transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Use My Location
                </button>
                <span id="geo-label" class="text-xs font-medium text-gray-400"></span>
            </div>
        </div>

        {{-- Geolocation Permission Banner --}}
        <div id="geo-banner" class="flex items-start gap-4 bg-white border border-blue-100 rounded-lg p-6 mb-8 shadow-sm">
            <div class="text-3xl mt-1">📡</div>
            <div>
                <p class="font-bold text-gray-900 text-[15px]">Enable location for the best experience</p>
                <p class="text-gray-500 text-sm mt-1">RigRadar will find stores nearest to you and show walking/driving distances in real time. Your location is never stored or shared.</p>
            </div>
        </div>

        {{-- Store Cards --}}
        <div id="store-cards" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($product->retailers->sortBy('pivot.price') as $retailer)
            <div class="store-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100"
                 data-retailer-id="{{ $retailer->id }}"
                 data-lat="{{ $retailer->latitude }}"
                 data-lng="{{ $retailer->longitude }}"
                 data-price="{{ $retailer->pivot->price }}">

                {{-- Card Header --}}
                <div class="px-5 pt-5 pb-4 border-b border-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            @if($retailer->logo_path)
                                @php
                                    $logoSrc = match(true) {
                                        Str::startsWith($retailer->logo_path, 'http') => $retailer->logo_path,
                                        Str::startsWith($retailer->logo_path, 'assets/') => asset($retailer->logo_path),
                                        default => asset('storage/'.$retailer->logo_path),
                                    };
                                @endphp
                                <img src="{{ $logoSrc }}" alt="{{ $retailer->name }} logo" class="w-10 h-10 object-contain rounded-md border border-gray-100 bg-white p-1">
                            @else
                                <div class="w-10 h-10 rounded-md border border-gray-100 bg-gray-100 flex items-center justify-center">
                                    <span class="text-xs font-bold text-gray-500">{{ substr($retailer->name, 0, 2) }}</span>
                                </div>
                            @endif
                            <div>
                                <div class="font-bold text-gray-900 text-[17px]">{{ $retailer->name }}</div>
                                <div class="flex items-center gap-1.5 text-[13px] font-medium text-gray-400 mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $retailer->location ?? 'Kuala Lumpur' }}
                                </div>
                            </div>
                        </div>

                        {{-- Availability Badge --}}
                        @if($retailer->pivot->availability_status == 'In Stock')
                            <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-xs font-bold px-2 py-1 rounded border border-green-100 flex-shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block"></span>
                                In Stock
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-red-50 text-red-700 text-xs font-bold px-2 py-1 rounded border border-red-100 flex-shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>
                                {{ $retailer->pivot->availability_status }}
                            </span>
                        @endif
                    </div>

                    {{-- Distance Badge (populated by JS) --}}
                    <div class="distance-badge mt-3 hidden">
                        <div class="inline-flex items-center gap-1.5 bg-blue-50 text-brand text-xs font-bold px-3 py-1 rounded">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            <span class="distance-text"></span>
                        </div>
                    </div>
                </div>

                {{-- Price & Actions --}}
                <div class="px-5 py-5">
                    <div class="flex items-baseline gap-2 mb-3">
                        <span class="text-[22px] font-bold text-gray-900">RM {{ number_format($retailer->pivot->price, 2) }}</span>
                        @php $minP = $product->retailers->min('pivot.price'); @endphp
                        @if($retailer->pivot->price == $minP)
                            <span class="text-[10px] font-bold text-green-700 bg-green-100 px-2 py-0.5 rounded uppercase tracking-wider">Best Price</span>
                        @endif
                    </div>
                    
                    {{-- Detailed Shipping Breakdown --}}
                    <div class="text-[13px] text-gray-600 bg-[#F8FAFC] border border-gray-100 rounded-lg p-3 mb-5 shadow-inner">
                        <div class="flex justify-between mb-1.5">
                            <span class="text-gray-500">Retail Price</span>
                            <span class="font-medium text-gray-800">RM {{ number_format($retailer->pivot->price, 2) }}</span>
                        </div>
                        <div class="flex justify-between mb-1.5">
                            <span class="text-gray-500 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                Est. Shipping
                            </span>
                            <span class="font-medium text-gray-800 shipping-cost text-xs italic">Calculating...</span>
                        </div>
                        <div class="flex justify-between border-t border-gray-200 mt-2 pt-2 font-bold">
                            <span class="text-brand">Total Delivered</span>
                            <span class="text-brand total-cost">Calculating...</span>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="retailer_id" value="{{ $retailer->id }}">
                            <button type="submit" class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-2.5 rounded-lg transition-colors text-sm shadow-sm">
                                Add to Cart
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="flex-1 block text-center bg-brand hover:bg-brand-dark text-white font-bold py-2.5 rounded-lg transition-colors text-sm shadow-sm">
                            Add to Cart
                        </a>
                        @endauth

                        @if($retailer->pivot->product_url)
                        <a href="{{ $retailer->pivot->product_url }}" target="_blank"
                           class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2.5 px-5 rounded-lg transition-colors text-sm">
                            Buy Direct
                        </a>
                        @endif
                    </div>

                    {{-- Directions Link (populated by JS) --}}
                    <div class="directions-link mt-4 hidden">
                        <a href="#" target="_blank"
                           class="flex items-center justify-center gap-1.5 w-full bg-white border border-gray-200 hover:border-gray-300 hover:bg-gray-50 text-gray-700 text-[13px] font-semibold py-2.5 rounded-lg transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            Get Directions on Google Maps
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ======================== --}}
{{-- GEOLOCATION JAVASCRIPT   --}}
{{-- ======================== --}}
<script>
    // Haversine formula — returns distance in km between two lat/lng pairs
    function haversineDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Earth radius in km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    }

    function formatDistance(km) {
        if (km < 1) return Math.round(km * 1000) + ' m away';
        return km.toFixed(1) + ' km away';
    }

    function applyDistances(userLat, userLng) {
        const storeContainer = document.getElementById('store-cards');
        const cards = Array.from(storeContainer.querySelectorAll('.store-card'));

        // Calculate distances for each card
        const cardsWithDistance = cards.map(card => {
            const storeLat = parseFloat(card.dataset.lat);
            const storeLng = parseFloat(card.dataset.lng);
            const dist = (storeLat && storeLng) ? haversineDistance(userLat, userLng, storeLat, storeLng) : null;

            // Calculate shipping and totals
            const basePrice = parseFloat(card.dataset.price);
            const shippingSpan = card.querySelector('.shipping-cost');
            const totalSpan = card.querySelector('.total-cost');
            
            let shippingCost = 15; // default flat rate
            if (dist !== null) {
                shippingCost = 10 + (dist * 0.5); // RM 10 base + RM 0.50 per km
            }
            const totalCost = basePrice + shippingCost;
            
            if (shippingSpan && totalSpan) {
                shippingSpan.textContent = '+ RM ' + shippingCost.toFixed(2);
                shippingSpan.classList.remove('text-xs', 'italic');
                totalSpan.textContent = 'RM ' + totalCost.toFixed(2);
            }

            // Populate distance badge
            if (dist !== null) {
                const badge = card.querySelector('.distance-badge');
                const distText = card.querySelector('.distance-text');
                badge.classList.remove('hidden');
                distText.textContent = formatDistance(dist);

                // Google Maps directions link
                const dirLink = card.querySelector('.directions-link');
                const anchor = dirLink.querySelector('a');
                anchor.href = `https://www.google.com/maps/dir/?api=1&destination=${storeLat},${storeLng}`;
                dirLink.classList.remove('hidden');
            }

            return { card, dist };
        });

        // Sort cards: nearest first, then by price if no distance
        cardsWithDistance.sort((a, b) => {
            if (a.dist === null && b.dist === null) return parseFloat(a.card.dataset.price) - parseFloat(b.card.dataset.price);
            if (a.dist === null) return 1;
            if (b.dist === null) return -1;
            return a.dist - b.dist;
        });

        // Re-render sorted cards
        cardsWithDistance.forEach(({ card }) => storeContainer.appendChild(card));

        // Hide the banner
        document.getElementById('geo-banner').classList.add('hidden');

        // Update label
        document.getElementById('geo-label').textContent = '✓ Sorted nearest to you';
        document.getElementById('locate-btn').classList.remove('bg-brand', 'hover:bg-brand-dark');
        document.getElementById('locate-btn').classList.add('bg-green-600', 'cursor-default');
        document.getElementById('locate-btn').disabled = true;
        document.getElementById('locate-btn').innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Location Active
        `;
    }

    function requestLocation(fallbackOnly = false) {
        const btn = document.getElementById('locate-btn');
        const label = document.getElementById('geo-label');
        
        // Default coordinates (Kuala Lumpur City Centre)
        const defaultLat = 3.1412;
        const defaultLng = 101.6865;

        // If we only want fallback (on page load), just apply the default distances without prompting
        if (fallbackOnly) {
            applyDistances(defaultLat, defaultLng);
            label.textContent = 'Distances estimated from Kuala Lumpur';
            return;
        }

        if (!navigator.geolocation) {
            label.textContent = '⚠ Geolocation not supported. Showing distances from Kuala Lumpur.';
            applyDistances(defaultLat, defaultLng);
            return;
        }

        btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Locating...`;
        label.textContent = 'Requesting your precise location...';

        navigator.geolocation.getCurrentPosition(
            (position) => {
                applyDistances(position.coords.latitude, position.coords.longitude);
                label.textContent = '✓ Sorted nearest to you';
            },
            (error) => {
                btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Use My Location`;
                label.textContent = error.code === 1
                    ? '⚠ Permission denied. Showing distances from Kuala Lumpur.'
                    : '⚠ Could not get location. Showing distances from Kuala Lumpur.';
                applyDistances(defaultLat, defaultLng);
            },
            { timeout: 10000, maximumAge: 60000 }
        );
    }

    // Auto-request location on page load
    navigator.permissions && navigator.permissions.query({ name: 'geolocation' }).then(result => {
        if (result.state === 'granted') {
            requestLocation(false); // get precise location silently
        } else {
            requestLocation(true); // just show the fallback KL distances immediately
        }
    }).catch(() => {
        // Fallback for browsers that don't support permissions API
        requestLocation(true);
    });
</script>
@endsection
