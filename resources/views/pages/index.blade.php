@extends('layouts.front')

@section('title', 'RigRadar - PC Parts Comparison & Marketplace')

@section('content')

<!-- Hero Carousel Section -->
<div class="bg-white py-6 w-full relative group">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <!-- Slider Container -->
        <div id="hero-slider" class="relative rounded-2xl overflow-hidden h-[460px] shadow-2xl">

            <!-- Slide 1: Main PC Build Banner -->
            <div class="slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-100">
                <img src="https://assetsio.gnwcdn.com/How-to-build-a-gaming-PC-header.jpg?width=1600&height=900&fit=crop&quality=100&format=png&enable=upscale&auto=webp" alt="PC Components" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                <div class="p-10 md:p-16 md:w-[55%] h-full relative z-10 flex flex-col justify-center">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-4 leading-tight tracking-tight drop-shadow-lg">Build Your<br>Dream PC</h2>
                    <p class="text-white/75 text-[15px] mb-8 max-w-sm leading-relaxed">Compare prices from top Malaysian retailers instantly. Find the best deals on GPUs, CPUs, and consumer devices.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ url('/products') }}" class="inline-flex items-center gap-1.5 bg-white text-gray-900 font-bold px-6 py-2.5 rounded-xl hover:bg-gray-50 transition-all shadow-md text-sm">Find your Parts &rarr;</a>
                        <a href="{{ url('/pc-builder') }}" class="inline-flex items-center gap-1.5 bg-brand hover:bg-brand-dark text-white font-bold px-6 py-2.5 rounded-xl transition-all text-sm shadow-md">🔧 PC Builder</a>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Laptops & MacBooks -->
            <div class="slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0">
                <img src="https://asia.dynabook.com/assets_new/images/portege-x30l-g-slide-1.png" alt="Laptops and MacBooks" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                <div class="p-10 md:p-16 md:w-[55%] h-full relative z-10 flex flex-col justify-center">
                    <div class="inline-flex items-center gap-1.5 bg-white/15 backdrop-blur-sm border border-white/25 text-white text-[11px] font-bold px-3 py-1.5 rounded-full mb-5 w-max tracking-widest uppercase">
                        Back To School
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-4 leading-tight tracking-tight drop-shadow-lg">Premium<br>Laptops</h2>
                    <p class="text-white/75 text-[15px] mb-8 max-w-sm leading-relaxed">From MacBooks to high-performance gaming rigs. Find the perfect mobile workstation.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ url('/devices') }}" class="inline-flex items-center bg-brand text-white font-bold px-8 py-2.5 rounded-xl hover:bg-brand-dark transition-all shadow-md text-sm">Shop Laptops</a>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Smart Devices -->
            <div class="slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0">
                <img src="{{ asset('assets/images/slider-image-3-1920x900.jpg') }}" alt="Desk Setup" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
                <div class="p-10 md:p-16 md:w-[55%] h-full relative z-10 flex flex-col justify-center">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-4 leading-tight tracking-tight drop-shadow-lg">Complete<br>Your Setup</h2>
                    <p class="text-white/75 text-[15px] mb-8 max-w-sm leading-relaxed">Discover top-rated monitors, tablets, and smartwatches at unbeatable prices across Malaysia.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ url('/devices') }}" class="inline-flex items-center bg-white text-gray-900 font-bold px-8 py-2.5 rounded-xl hover:bg-gray-50 transition-all shadow-md text-sm">Explore Devices</a>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 backdrop-blur-sm border border-white/15 text-white w-10 h-10 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all z-20 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 backdrop-blur-sm border border-white/15 text-white w-10 h-10 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all z-20 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <!-- Indicators (pill style) -->
            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-20 items-center">
                <button onclick="goToSlide(0)" class="slide-dot h-2 rounded-full bg-white transition-all duration-300 w-6 opacity-100 shadow"></button>
                <button onclick="goToSlide(1)" class="slide-dot h-2 rounded-full bg-white transition-all duration-300 w-2 opacity-50 hover:opacity-80 shadow"></button>
                <button onclick="goToSlide(2)" class="slide-dot h-2 rounded-full bg-white transition-all duration-300 w-2 opacity-50 hover:opacity-80 shadow"></button>
            </div>
        </div>

    </div>
</div>

<!-- Official Retailer Parts (Soft Slate Background) -->
<div class="bg-gray-100 py-16 w-full border-y border-gray-200 shadow-inner">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h3 class="text-[28px] font-bold text-gray-900 tracking-tight">Official Retailer Parts</h3>
            </div>
            <a href="{{ url('/products') }}" class="text-brand hover:text-brand-dark text-sm font-semibold transition-colors">View all</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-5">
            @forelse($featuredProducts as $product)
                @php
                    $minPrice = $product->retailers->min('pivot.price');
                    $retailerCount = $product->retailers->count();
                @endphp
                <div class="bg-white rounded-xl overflow-hidden group hover:shadow-xl transition-all duration-300 shadow-md relative flex flex-col h-full border border-gray-100 hover:-translate-y-1">
                    <div class="h-44 bg-[#F9FAFB] flex items-center justify-center p-6 relative">
                        @php
                            $imgSrc = match(true) {
                                !$product->image_path => null,
                                Str::startsWith($product->image_path, 'http') => $product->image_path,
                                Str::startsWith($product->image_path, 'assets/') => asset($product->image_path),
                                default => asset('storage/'.$product->image_path),
                            };
                        @endphp
                        <img src="{{ $imgSrc }}" alt="{{ $product->name }}" class="h-full object-contain group-hover:scale-105 transition-transform duration-300 mix-blend-multiply">
                    </div>
                    <div class="px-4 pb-4 pt-3 flex-1 flex flex-col">
                        <div class="text-xs text-gray-500 mb-1 font-medium">{{ $product->brand }}</div>
                        <h4 class="font-semibold text-gray-900 text-[15px] leading-snug line-clamp-2 mb-2">
                            <a href="{{ route('products.details', $product->id) }}"><span class="absolute inset-0"></span>{{ $product->name }}</a>
                        </h4>
                        
                        <div class="mt-auto">
                            @if($retailerCount > 0)
                                <div class="text-lg font-bold text-gray-900 mb-0.5">RM {{ number_format($minPrice, 2) }}</div>
                            @else
                                <div class="text-sm font-medium text-gray-400 mb-0.5">Price unavailable</div>
                            @endif
                            <a href="{{ route('products.details', $product->id) }}" class="mt-3 block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-900 font-semibold py-2 rounded-lg transition-colors text-sm relative z-10">
                                Buy Now
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">No official products available.</div>
            @endforelse
        </div>
    </div>
</div>

<!-- User Marketplace Items (Soft Gray Background) -->
<div class="bg-gray-50 py-16 w-full border-b border-gray-200 shadow-inner">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h3 class="text-[28px] font-bold text-gray-900 tracking-tight">User Marketplace</h3>
            </div>
            <a href="{{ url('/marketplace') }}" class="text-brand hover:text-brand-dark text-sm font-semibold transition-colors">View all</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-5">
            @forelse($marketplaceItems as $item)
                <div class="bg-white rounded-xl overflow-hidden group hover:shadow-xl transition-all duration-300 shadow-md relative flex flex-col h-full border border-gray-200 hover:-translate-y-1">
                    <div class="h-44 bg-[#F9FAFB] flex items-center justify-center p-4 relative">
                        @php
                            $imgSrc = match(true) {
                                !$item->image_path => null,
                                Str::startsWith($item->image_path, 'http') => $item->image_path,
                                Str::startsWith($item->image_path, 'assets/') => asset($item->image_path),
                                default => asset('storage/'.$item->image_path),
                            };
                        @endphp
                        <img src="{{ $imgSrc }}" alt="{{ $item->title }}" class="h-full object-contain group-hover:scale-105 transition-transform duration-300 mix-blend-multiply">
                        <div class="absolute top-2 left-2 bg-gray-900 text-white text-[10px] uppercase px-2 py-1 rounded font-bold shadow-sm">
                            {{ $item->condition }}
                        </div>
                    </div>
                    <div class="px-4 pb-4 pt-3 flex-1 flex flex-col">
                        <h4 class="font-semibold text-gray-900 text-[15px] leading-snug line-clamp-2 mb-2">
                            <a href="{{ route('marketplace.details', $item->id) }}"><span class="absolute inset-0"></span>{{ $item->title }}</a>
                        </h4>
                        
                        <div class="mt-auto">
                            <div class="text-lg font-bold text-gray-900 mb-1">RM {{ number_format($item->price, 2) }}</div>
                            <div class="flex items-center text-[11px] text-gray-500 mt-1">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $item->location }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500">No marketplace listings available.</div>
            @endforelse
        </div>
    </div>
</div>

<!-- "Who's talking about us?" Marquee -->
<div class="bg-[#F3F4F6] py-14 w-full overflow-hidden border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-10">
        <h3 class="text-2xl font-bold text-gray-900">Our Official Partners</h3>
    </div>
    
    <!-- Marquee Container -->
    <div class="relative flex overflow-x-hidden group">
        <!-- Mask for fading edges -->
        <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-[#F3F4F6] to-transparent z-10 pointer-events-none"></div>
        <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-[#F3F4F6] to-transparent z-10 pointer-events-none"></div>

        <!-- First Marquee Track -->
        <div class="animate-marquee whitespace-nowrap flex items-center min-w-full justify-around gap-16 px-8">
            <span class="text-4xl font-black text-gray-400 opacity-60 tracking-tight">Harvey Norman</span>
            <span class="text-4xl font-black text-gray-400 opacity-60"> Apple</span>
            <span class="text-4xl font-black text-gray-400 opacity-60 tracking-widest">SWITCH</span>
            <span class="text-4xl font-black text-gray-800 tracking-tighter">TMT</span>
            <span class="text-4xl font-black text-gray-400 opacity-60">Machines</span>
            <span class="text-4xl font-black text-gray-400 opacity-60">ALL IT</span>
        </div>
        <!-- Second Marquee Track (Seamless Loop) -->
        <div class="animate-marquee whitespace-nowrap flex items-center min-w-full justify-around gap-16 px-8 absolute top-0" style="left: 100%;">
            <span class="text-4xl font-black text-gray-400 opacity-60 tracking-tight">Harvey Norman</span>
            <span class="text-4xl font-black text-gray-400 opacity-60"> Apple</span>
            <span class="text-4xl font-black text-gray-400 opacity-60 tracking-widest">SWITCH</span>
            <span class="text-4xl font-black text-gray-800 tracking-tighter">TMT</span>
            <span class="text-4xl font-black text-gray-400 opacity-60">Machines</span>
            <span class="text-4xl font-black text-gray-400 opacity-60">ALL IT</span>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 mt-10 text-center">
        <p class="text-xl md:text-2xl font-black text-gray-900">"RigRadar – The smart way to buy and sell authentic devices and parts."</p>
    </div>
</div>

<script>
    // Hero Slider Logic
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slide-dot');
    
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('opacity-100');
            slide.classList.add('opacity-0');
            dots[i].classList.remove('opacity-100', 'w-6');
            dots[i].classList.add('opacity-50', 'w-2');

            if (i === index) {
                slide.classList.remove('opacity-0');
                slide.classList.add('opacity-100');
                dots[i].classList.remove('opacity-50', 'w-2');
                dots[i].classList.add('opacity-100', 'w-6');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    function goToSlide(index) {
        currentSlide = index;
        showSlide(currentSlide);
    }

    // Auto-advance slider
    setInterval(nextSlide, 5000);
</script>

@endsection
