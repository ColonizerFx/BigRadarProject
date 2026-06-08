@extends('layouts.front')

@section('title', 'BigRadar - PC Parts Comparison & Marketplace')

@section('content')

<!-- Hero Carousel Section (White Background) -->
<div class="bg-white py-6 w-full relative group">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        
        <!-- Slider Container -->
        <div id="hero-slider" class="relative rounded-[16px] overflow-hidden shadow-lg h-[400px]">
            
            <!-- Slide 1: Main PC Build Banner -->
            <div class="slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-100 bg-gray-900">
                <img src="https://images.unsplash.com/photo-1587202372616-b43abea06c2a?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="PC Components" class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
                <div class="p-8 md:p-14 md:w-[60%] h-full relative z-10 flex flex-col justify-center">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-5 leading-tight tracking-tight">Build Your<br>Dream PC</h2>
                    <p class="text-gray-300 text-[15px] mb-8 max-w-sm">Compare prices from top Malaysian retailers instantly. Find the best deals on GPUs, CPUs, and consumer devices.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ url('/products') }}" class="inline-block bg-white text-gray-900 font-bold px-6 py-2.5 rounded-lg hover:bg-gray-100 transition-colors shadow-sm text-sm">Find your Parts &rarr;</a>
                        <a href="{{ url('/pc-builder') }}" class="inline-block bg-brand hover:bg-brand-dark text-white font-bold px-6 py-2.5 rounded-lg transition-colors text-sm border border-transparent shadow-sm">🔧 PC Builder</a>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Laptops & MacBooks -->
            <div class="slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 bg-gray-900">
                <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Laptops and MacBooks" class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
                <div class="p-8 md:p-14 md:w-[60%] h-full relative z-10 flex flex-col justify-center">
                    <div class="inline-flex items-center gap-2 bg-white text-gray-900 text-xs font-black px-3 py-1.5 rounded-full mb-5 w-max">
                        BACK TO SCHOOL
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-5 leading-tight tracking-tight">Premium<br>Laptops</h2>
                    <p class="text-gray-300 text-[15px] mb-8 font-semibold max-w-sm">From MacBooks to high-performance gaming rigs. Find the perfect mobile workstation.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ url('/devices') }}" class="inline-block bg-brand text-white font-bold px-8 py-3 rounded-lg hover:bg-brand-dark transition-colors shadow-sm text-sm">Shop Laptops</a>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Smart Devices -->
            <div class="slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 bg-gray-900">
                <img src="https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Desk Setup" class="absolute inset-0 w-full h-full object-cover opacity-50 mix-blend-overlay">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
                <div class="p-8 md:p-14 md:w-[60%] h-full relative z-10 flex flex-col justify-center">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-5 leading-tight tracking-tight">Complete<br>Your Setup</h2>
                    <p class="text-gray-300 text-[15px] mb-8 font-semibold max-w-sm">Discover top-rated monitors, tablets, and smartwatches at unbeatable prices across Malaysia.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ url('/devices') }}" class="inline-block bg-white text-gray-900 font-bold px-8 py-3 rounded-lg hover:bg-gray-100 transition-colors shadow-sm text-sm">Explore Devices</a>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/30 backdrop-blur-md border border-white/20 text-white w-10 h-10 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all z-20 shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/30 backdrop-blur-md border border-white/20 text-white w-10 h-10 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all z-20 shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <!-- Indicators -->
            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-20">
                <button onclick="goToSlide(0)" class="slide-dot w-2 h-2 rounded-full bg-white opacity-100 transition-all shadow-sm"></button>
                <button onclick="goToSlide(1)" class="slide-dot w-2 h-2 rounded-full bg-white opacity-40 hover:opacity-100 transition-all shadow-sm"></button>
                <button onclick="goToSlide(2)" class="slide-dot w-2 h-2 rounded-full bg-white opacity-40 hover:opacity-100 transition-all shadow-sm"></button>
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
                        <img src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : ($product->image_path ? asset('storage/'.$product->image_path) : 'https://images.unsplash.com/photo-1591488320449-011701bb6704?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80') }}" alt="{{ $product->name }}" class="h-full object-contain group-hover:scale-105 transition-transform duration-300 mix-blend-multiply">
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
                        <img src="{{ Str::startsWith($item->image_path, 'http') ? $item->image_path : ($item->image_path ? asset('storage/'.$item->image_path) : 'https://images.unsplash.com/photo-1587202372616-b43abea06c2a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80') }}" alt="{{ $item->title }}" class="h-full object-contain group-hover:scale-105 transition-transform duration-300 mix-blend-multiply">
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
        <p class="text-xl md:text-2xl font-black text-gray-900">"BigRadar – The smart way to buy and sell authentic devices and parts."</p>
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
            dots[i].classList.remove('opacity-100');
            dots[i].classList.add('opacity-40');
            
            if(i === index) {
                slide.classList.remove('opacity-0');
                slide.classList.add('opacity-100');
                dots[i].classList.remove('opacity-40');
                dots[i].classList.add('opacity-100');
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
