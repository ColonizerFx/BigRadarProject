<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BigRadar - Price Comparison & Marketplace')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts and Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-800 flex flex-col min-h-screen">
    
    <!-- Top Thin Header (eBay Style) -->
    <div class="border-b border-gray-200 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-1">
            <div class="flex items-center space-x-4">
                @auth
                    <span>Hi, <a href="{{ url('/dashboard') }}" class="text-blue-600 hover:underline font-medium">{{ Auth::user()->name }}</a>!</span>
                @else
                    <span>Hi! <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Sign in</a> or <a href="{{ route('register') }}" class="text-blue-600 hover:underline">register</a></span>
                @endauth
                <a href="#" class="hover:underline">Daily Deals</a>
                <a href="#" class="hover:underline">Help & Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('marketplace.create') }}" class="hover:underline">Sell</a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Sell</a>
                @endauth
                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:underline">Watchlist</a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Watchlist</a>
                @endauth
                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:underline flex items-center gap-1" title="Notifications">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </a>
                @endauth
                @auth
                    @php $cartCount = count(session()->get('cart', [])); @endphp
                    <a href="{{ route('cart.index') }}" class="hover:underline flex items-center gap-1 relative" title="Shopping Cart">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        @if($cartCount > 0)
                            <span class="absolute -top-1.5 -right-2 bg-red-500 text-white text-[9px] font-bold rounded-full w-4 h-4 flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:underline flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Header & Search -->
    <div class="border-b border-gray-200 bg-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-4">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-3xl font-black text-blue-600 tracking-tighter flex-shrink-0 mr-4" style="color: #0064D2;">
                BigRadar
            </a>

            <!-- Shop by category dropdown -->
            <div class="hidden md:block flex-shrink-0">
                <button class="text-gray-600 text-sm flex items-center gap-1 hover:text-blue-600">
                    Shop by category
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>

            <!-- Search Bar -->
            <form action="{{ url('/products') }}" method="GET" class="flex-1 flex border-2 border-gray-800 rounded-sm overflow-hidden">
                <div class="flex items-center px-3 text-gray-500 bg-white border-r border-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="w-full border-0 py-2.5 px-3 text-gray-800 placeholder-gray-500 focus:ring-0" placeholder="Search for PC Parts, GPUs, CPUs...">
                <select name="category" class="hidden md:block bg-white border-l border-r-0 border-t-0 border-b-0 border-gray-300 text-gray-600 text-sm focus:ring-0 py-0 pl-3 pr-8">
                    <option value="">All Categories</option>
                    <option value="Graphics Card" {{ request('category') == 'Graphics Card' ? 'selected' : '' }}>Graphics Cards</option>
                    <option value="Processor" {{ request('category') == 'Processor' ? 'selected' : '' }}>Processors</option>
                    <option value="Motherboard" {{ request('category') == 'Motherboard' ? 'selected' : '' }}>Motherboards</option>
                    <option value="Memory" {{ request('category') == 'Memory' ? 'selected' : '' }}>Memory</option>
                    <option value="Storage" {{ request('category') == 'Storage' ? 'selected' : '' }}>Storage</option>
                    <option value="Power Supply" {{ request('category') == 'Power Supply' ? 'selected' : '' }}>Power Supplies</option>
                    <option value="PC Case" {{ request('category') == 'PC Case' ? 'selected' : '' }}>PC Cases</option>
                    <option value="Monitor" {{ request('category') == 'Monitor' ? 'selected' : '' }}>Monitors</option>
                    <option value="Apple Devices" {{ request('category') == 'Apple Devices' ? 'selected' : '' }}>Apple Devices</option>
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 font-medium transition-colors" style="background-color: #0064D2;">Search</button>
            </form>

            <a href="#" class="text-xs text-gray-500 hover:text-blue-600 hidden lg:block flex-shrink-0">Advanced</a>
        </div>
    </div>

    <!-- Category Navigation -->
    <div class="border-b border-gray-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-6 py-2 overflow-x-auto no-scrollbar">
                <a href="{{ url('/') }}" class="text-gray-700 hover:underline text-sm font-medium whitespace-nowrap {{ request()->is('/') ? 'border-b-2 border-gray-800' : '' }}">Home</a>
                <a href="{{ url('/products') }}" class="text-gray-700 hover:underline text-sm font-medium whitespace-nowrap {{ request()->is('products*') ? 'border-b-2 border-gray-800' : '' }}">Price Comparison (Official)</a>
                <a href="{{ url('/marketplace') }}" class="text-gray-700 hover:underline text-sm font-medium whitespace-nowrap {{ request()->is('marketplace*') ? 'border-b-2 border-gray-800' : '' }}">User Marketplace (C2C)</a>
                <a href="{{ url('/about') }}" class="text-gray-700 hover:underline text-sm font-medium whitespace-nowrap">About Us</a>
                <a href="{{ url('/contact') }}" class="text-gray-700 hover:underline text-sm font-medium whitespace-nowrap">Contact</a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow bg-gray-50 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 pt-10 pb-6 text-xs text-gray-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <h4 class="font-bold text-gray-800 mb-3">Buy</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Registration</a></li>
                    <li><a href="#" class="hover:underline">Bidding & buying help</a></li>
                    <li><a href="#" class="hover:underline">Stores</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-3">Sell</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Start selling</a></li>
                    <li><a href="#" class="hover:underline">Learn to sell</a></li>
                    <li><a href="#" class="hover:underline">Affiliates</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-3">About BigRadar</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Company info</a></li>
                    <li><a href="#" class="hover:underline">News</a></li>
                    <li><a href="#" class="hover:underline">Policies</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-3">Help & Contact</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Seller Information Center</a></li>
                    <li><a href="#" class="hover:underline">Contact us</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 text-center text-gray-500">
            Copyright &copy; {{ date('Y') }} BigRadar. All Rights Reserved. Accessibility, User Agreement, Privacy, Payments Terms of Use, Cookies and AdChoice.
        </div>
    </footer>
</body>
</html>
