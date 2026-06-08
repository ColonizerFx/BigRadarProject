@extends('layouts.front')

@section('title', $item->title . ' - BigRadar Marketplace')

@section('content')

<!-- Top Section (White Background) -->
<div class="bg-white py-8 w-full border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
            <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
            <span>/</span>
            <a href="{{ url('/marketplace') }}" class="hover:text-brand transition-colors">User Marketplace</a>
            <span>/</span>
            <a href="{{ url('/marketplace?category='.urlencode($item->category)) }}" class="hover:text-brand transition-colors">{{ $item->category }}</a>
            <span>/</span>
            <span class="text-gray-900 font-medium truncate">{{ $item->title }}</span>
        </nav>

        {{-- Product Info Section --}}
        <div class="lg:flex lg:gap-10">
            
            {{-- Image --}}
            <div class="lg:w-2/5 bg-[#F9FAFB] rounded-lg p-8 flex items-center justify-center min-h-[380px] mb-6 lg:mb-0 relative">
                <div class="absolute top-4 left-4 z-10 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-md shadow-sm">
                    {{ $item->condition }}
                </div>
                @php
                    $imgSrc = match(true) {
                        !$item->image_path => null,
                        Str::startsWith($item->image_path, 'http') => $item->image_path,
                        Str::startsWith($item->image_path, 'assets/') => asset($item->image_path),
                        default => asset('storage/'.$item->image_path),
                    };
                @endphp
                <img src="{{ $imgSrc ?? asset('assets/images/placeholder-part.png') }}"
                     alt="{{ $item->title }}"
                     class="object-contain w-full max-h-[340px] mix-blend-multiply">
            </div>

            {{-- Details --}}
            <div class="lg:w-3/5">
                <div class="text-xs font-bold text-brand uppercase tracking-widest mb-2">{{ $item->category }}</div>
                <h1 class="text-[32px] font-bold text-gray-900 mb-3 leading-snug tracking-tight" style="font-family: 'Inter', sans-serif;">{{ $item->title }}</h1>

                <div class="flex items-center gap-3 mb-5 text-sm">
                    <span class="text-gray-500 font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $item->location }}
                    </span>
                    <span class="text-gray-300">|</span>
                    <span class="text-gray-500 font-medium">Listed {{ $item->created_at->diffForHumans() }}</span>
                </div>

                @if(session('success'))
                    <div class="bg-blue-50 text-brand px-4 py-3 rounded-lg mb-4 text-sm font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Price Summary Box --}}
                <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6 shadow-sm">
                    <div class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-1">Asking Price</div>
                    <div class="text-[32px] font-bold text-gray-900 mb-4" style="font-family: 'Inter', sans-serif;">RM {{ number_format($item->price, 2) }}</div>
                    
                    {{-- Action Buttons --}}
                    @auth
                        @if(Auth::id() !== $item->user_id)
                            <div class="space-y-3">
                                <form action="{{ route('cart.buyMarketplace', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-center bg-brand hover:bg-brand-dark text-white font-bold py-3 rounded-lg transition-colors text-sm shadow-sm flex justify-center items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        Buy Now
                                    </button>
                                </form>
                                <form action="{{ route('chat.initiate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="listing_id" value="{{ $item->id }}">
                                    <button type="submit" class="w-full text-center border border-gray-300 hover:border-brand hover:text-brand text-gray-800 font-bold py-3 rounded-lg transition-colors text-sm flex justify-center items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                        Chat with Seller
                                    </button>
                                </form>
                            </div>
                        @else
                            <button disabled class="w-full text-center border border-gray-200 bg-gray-50 rounded-lg py-3 text-sm font-bold text-gray-400 cursor-not-allowed">
                                Your Listing
                            </button>
                        @endif
                    @else
                        <div class="space-y-3">
                            <a href="{{ route('login') }}" class="w-full block text-center bg-brand hover:bg-brand-dark text-white font-bold py-3 rounded-lg transition-colors text-sm shadow-sm">
                                Login to Buy
                            </a>
                            <a href="{{ route('login') }}" class="w-full block text-center border border-gray-300 hover:border-brand hover:text-brand text-gray-800 font-bold py-3 rounded-lg transition-colors text-sm">
                                Login to Chat
                            </a>
                        </div>
                    @endauth
                </div>

                {{-- Item Specs --}}
                <div class="border-t border-gray-100 pt-5 mb-5">
                    <h3 class="font-bold text-gray-900 mb-3 text-sm">Item Specifics</h3>
                    <div class="grid grid-cols-2 gap-y-3 gap-x-6 text-sm">
                        <div class="flex"><span class="text-gray-400 w-24 flex-shrink-0">Condition:</span><span class="font-semibold text-gray-900">{{ $item->condition }}</span></div>
                        <div class="flex"><span class="text-gray-400 w-24 flex-shrink-0">Category:</span><span class="font-semibold text-gray-900">{{ $item->category }}</span></div>
                        <div class="flex"><span class="text-gray-400 w-24 flex-shrink-0">Deal Method:</span><span class="font-semibold text-gray-900">Meet up / Delivery</span></div>
                        <div class="flex"><span class="text-gray-400 w-24 flex-shrink-0">Location:</span><span class="font-semibold text-gray-900">{{ $item->location }}</span></div>
                    </div>
                </div>

                @if($item->description)
                <div class="border-t border-gray-100 pt-5">
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">Description</h3>
                    <p class="text-[15px] text-gray-600 leading-relaxed whitespace-pre-wrap">{{ $item->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- SELLER PROFILE SECTION (Slate Background) -->
<div class="bg-[#F8FAFC] py-16 w-full border-t border-gray-200 shadow-inner">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h2 class="text-[28px] font-bold text-gray-900 tracking-tight mb-8" style="font-family: 'Inter', sans-serif;">About the Seller</h2>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 sm:flex sm:items-start sm:justify-between gap-8">
                
                {{-- Profile Info --}}
                <div class="flex items-center gap-5 mb-6 sm:mb-0">
                    <div class="w-20 h-20 bg-brand text-white rounded-full flex items-center justify-center text-3xl font-bold shadow-inner">
                        {{ strtoupper(substr($item->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $item->user->name }}</h3>
                        <div class="text-sm text-gray-500 mt-1 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Joined {{ $item->user->created_at->format('M Y') }}
                        </div>
                        <div class="mt-2 flex items-center gap-1 text-yellow-400 text-sm">
                            &#9733;&#9733;&#9733;&#9733;&#9733; <span class="text-gray-900 font-bold ml-1">5.0</span> <span class="text-gray-400 ml-1">(12 reviews)</span>
                        </div>
                    </div>
                </div>

                {{-- Stats / Trust Indicators --}}
                <div class="flex flex-col gap-3 min-w-[200px]">
                    <div class="flex items-center justify-between text-sm bg-gray-50 px-4 py-2 rounded-lg border border-gray-100">
                        <span class="text-gray-500">Items Sold</span>
                        <span class="font-bold text-gray-900">24</span>
                    </div>
                    <div class="flex items-center justify-between text-sm bg-gray-50 px-4 py-2 rounded-lg border border-gray-100">
                        <span class="text-gray-500">Response Rate</span>
                        <span class="font-bold text-green-600">100%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm bg-gray-50 px-4 py-2 rounded-lg border border-gray-100">
                        <span class="text-gray-500">Verified Identity</span>
                        <span class="text-brand"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                    </div>
                </div>
            </div>
            
            {{-- Reviews Section --}}
            <div class="border-t border-gray-100 bg-[#F9FAFB] p-8">
                <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wider">Recent Reviews</h4>
                
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center text-xs font-bold text-gray-600">J</div>
                                <span class="font-semibold text-gray-900 text-sm">Jason L.</span>
                            </div>
                            <div class="text-xs text-gray-400">1 week ago</div>
                        </div>
                        <div class="text-yellow-400 text-xs mb-1">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="text-sm text-gray-600">"Great seller! The GPU was exactly as described. Fast shipping and very responsive to questions. Highly recommended!"</p>
                    </div>

                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-gray-200 rounded-full flex items-center justify-center text-xs font-bold text-gray-600">S</div>
                                <span class="font-semibold text-gray-900 text-sm">Sarah M.</span>
                            </div>
                            <div class="text-xs text-gray-400">1 month ago</div>
                        </div>
                        <div class="text-yellow-400 text-xs mb-1">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="text-sm text-gray-600">"Smooth transaction. Met up for the deal and the item was in perfect condition. Thank you!"</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
