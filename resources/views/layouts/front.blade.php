<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BigRadar - Price Comparison & Marketplace')</title>

    <!-- CompAsia-style: Inter font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts and Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-active { color: #2563EB; font-weight: 700; }
        .nav-link { display: inline-block; transition: color 0.2s; padding: 12px 0; }
        .nav-link:hover { color: #2563EB; }
    </style>
</head>
<body class="antialiased bg-white text-gray-800 flex flex-col min-h-screen" style="font-family: 'Inter', sans-serif;">

    <!-- Main Header -->
    <div class="bg-white border-b border-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-8">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-3xl font-black text-brand tracking-tight flex-shrink-0 transition-opacity hover:opacity-80" style="font-family: 'Inter', sans-serif; letter-spacing: -0.5px;">
                BigRadar
            </a>

            <!-- Search Bar — CompAsia pill style -->
            <form action="{{ url('/products') }}" method="GET" class="flex-1 flex items-center bg-gray-100 rounded-full border border-transparent focus-within:border-gray-300 focus-within:bg-white transition-all overflow-hidden pl-5 pr-2 py-1 shadow-inner max-w-2xl">
                <input type="text" name="search" value="{{ request('search') }}" class="w-full border-0 bg-transparent py-2 text-gray-800 placeholder-gray-500 focus:ring-0 text-sm font-medium" placeholder="Search products, pages, posts...">
                <button type="submit" class="text-gray-500 hover:text-brand p-2 rounded-full hover:bg-white transition-colors ml-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>

            <!-- Right Actions -->
            <div class="flex items-center space-x-6 text-gray-700 flex-shrink-0">
                <a href="{{ route('marketplace.create') }}" class="flex items-center gap-2 border border-gray-300 rounded-lg px-4 py-2 text-sm font-semibold hover:border-gray-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Sell Item
                </a>
                
                <a href="{{ url('/contact') }}" class="hover:text-brand transition-colors" title="Help">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </a>

                @auth
                    @php $unreadCount = Auth::user()->unreadNotifications->where('type', 'App\Notifications\NewMessageNotification')->count(); @endphp
                    <a href="{{ route('chat.index') }}" class="hover:text-brand transition-colors relative" title="Messages">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        @if($unreadCount > 0)
                            <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ url('/dashboard') }}" class="hover:text-brand transition-colors" title="Account">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-brand transition-colors" title="Account">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </a>
                @endauth

                @php $cartCount = count(session()->get('cart', [])); @endphp
                <a href="{{ route('cart.index') }}" class="hover:text-brand transition-colors relative" title="Cart">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </div>
    </div>

    <!-- Centered Category Navigation — CompAsia Style -->
    <div class="bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex justify-center items-center space-x-10 overflow-x-auto no-scrollbar">
                <a href="{{ url('/products') }}" class="nav-link text-[15px] font-bold whitespace-nowrap {{ request()->is('products*') ? 'nav-active text-gray-900' : 'text-gray-600' }}">Find your Parts</a>
                <span class="h-4 w-px bg-gray-300"></span>
                <a href="{{ url('/devices') }}" class="nav-link text-[15px] font-bold whitespace-nowrap {{ request()->is('devices*') ? 'nav-active text-gray-900' : 'text-gray-600' }}">Devices</a>
                <span class="h-4 w-px bg-gray-300"></span>
                <a href="{{ url('/pc-builder') }}" class="nav-link text-[15px] font-bold whitespace-nowrap {{ request()->is('pc-builder*') ? 'nav-active text-gray-900' : 'text-gray-600' }}">PC Builder</a>
                <span class="h-4 w-px bg-gray-300"></span>
                <a href="{{ url('/marketplace') }}" class="nav-link text-[15px] font-bold whitespace-nowrap {{ request()->is('marketplace*') ? 'nav-active text-gray-900' : 'text-gray-600' }}">User Marketplace</a>
                <span class="h-4 w-px bg-gray-300"></span>
                <a href="{{ url('/about') }}" class="nav-link text-[15px] font-bold whitespace-nowrap {{ request()->is('about*') ? 'nav-active text-gray-900' : 'text-gray-600' }}">About Us</a>
                <span class="h-4 w-px bg-gray-300"></span>
                <a href="{{ url('/contact') }}" class="nav-link text-[15px] font-bold whitespace-nowrap text-gray-600">Contact Us</a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow bg-white relative w-full animate-fade-in-up">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 pt-10 pb-6 text-xs text-gray-500" style="font-family: 'Inter', sans-serif;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-5 gap-8 mb-8">
            <div class="col-span-2 md:col-span-1">
                <a href="{{ url('/') }}" class="text-xl font-black text-brand mb-3 inline-block">BigRadar</a>
                <p class="text-gray-400 text-xs leading-relaxed">Your trusted platform for authentic tech and hardware.</p>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-3 text-sm">Shop</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/products') }}" class="hover:text-brand transition-colors">Find your Parts</a></li>
                    <li><a href="{{ url('/devices') }}" class="hover:text-brand transition-colors">Devices</a></li>
                    <li><a href="{{ url('/pc-builder') }}" class="hover:text-brand transition-colors">PC Builder</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-3 text-sm">Marketplace</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/marketplace') }}" class="hover:text-brand transition-colors">Browse Listings</a></li>
                    @auth
                        <li><a href="{{ route('marketplace.create') }}" class="hover:text-brand transition-colors">Sell an Item</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-brand transition-colors">Start Selling</a></li>
                    @endauth
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-3 text-sm">About BigRadar</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/about') }}" class="hover:text-brand transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-brand transition-colors">Policies</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 mb-3 text-sm">Help & Contact</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/contact') }}" class="hover:text-brand transition-colors">Contact us</a></li>
                    <li><a href="#" class="hover:text-brand transition-colors">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-gray-100 pt-6 text-center text-gray-400">
            Copyright &copy; {{ date('Y') }} BigRadar. All Rights Reserved.
        </div>
    </footer>
</body>
</html>
