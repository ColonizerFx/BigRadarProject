@extends('layouts.front')

@section('title', 'Checkout - RigRadar')

@section('content')

<div class="bg-[#F8FAFC] py-12 w-full min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-[32px] font-bold text-gray-900 tracking-tight" style="font-family: 'Inter', sans-serif;">Checkout</h1>
            <p class="text-gray-500 mt-1 text-sm">Please provide your details to complete your order.</p>
        </div>

        <form action="{{ route('cart.checkout') }}" method="POST" class="lg:flex lg:gap-10">
            @csrf
            
            {{-- Left Column: Forms --}}
            <div class="lg:w-2/3 space-y-6">
                
                {{-- Shipping Address --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <span class="bg-brand text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                        Shipping Information
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">First Name</label>
                            <input type="text" name="first_name" required value="{{ Auth::user()->name ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-brand focus:border-brand text-sm transition-colors bg-gray-50 focus:bg-white" placeholder="John">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="last_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-brand focus:border-brand text-sm transition-colors bg-gray-50 focus:bg-white" placeholder="Doe">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" required value="{{ Auth::user()->email ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-brand focus:border-brand text-sm transition-colors bg-gray-50 focus:bg-white" placeholder="john@example.com">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Street Address</label>
                            <input type="text" name="address" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-brand focus:border-brand text-sm transition-colors bg-gray-50 focus:bg-white" placeholder="123 Main St, Apt 4B">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">City</label>
                            <input type="text" name="city" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-brand focus:border-brand text-sm transition-colors bg-gray-50 focus:bg-white" placeholder="Kuala Lumpur">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Postcode</label>
                            <input type="text" name="postcode" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-brand focus:border-brand text-sm transition-colors bg-gray-50 focus:bg-white" placeholder="50000">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">State</label>
                            <select name="state" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-brand focus:border-brand text-sm transition-colors bg-gray-50 focus:bg-white appearance-none">
                                <option>Kuala Lumpur</option>
                                <option>Selangor</option>
                                <option>Penang</option>
                                <option>Johor</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <span class="bg-brand text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span>
                        Payment Method
                    </h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-4 border border-brand bg-blue-50 rounded-lg cursor-pointer transition-colors relative overflow-hidden">
                            <input type="radio" name="payment_method" value="card" checked class="text-brand focus:ring-brand w-4 h-4">
                            <div class="flex-1 font-semibold text-brand">Credit / Debit Card</div>
                            <div class="flex gap-1">
                                <span class="bg-white border border-blue-200 px-2 py-0.5 rounded text-[10px] font-bold text-gray-500">VISA</span>
                                <span class="bg-white border border-blue-200 px-2 py-0.5 rounded text-[10px] font-bold text-gray-500">MC</span>
                            </div>
                        </label>
                        
                        <label class="flex items-center gap-3 p-4 border border-gray-200 hover:border-brand hover:bg-blue-50 rounded-lg cursor-pointer transition-colors">
                            <input type="radio" name="payment_method" value="fpx" class="text-brand focus:ring-brand w-4 h-4">
                            <div class="flex-1 font-semibold text-gray-700">Online Banking (FPX)</div>
                        </label>
                        
                        <label class="flex items-center gap-3 p-4 border border-gray-200 hover:border-brand hover:bg-blue-50 rounded-lg cursor-pointer transition-colors">
                            <input type="radio" name="payment_method" value="ewallet" class="text-brand focus:ring-brand w-4 h-4">
                            <div class="flex-1 font-semibold text-gray-700">E-Wallet (TNG, GrabPay)</div>
                        </label>
                    </div>

                    <div class="mt-4 p-4 bg-gray-50 border border-gray-100 rounded-lg text-xs text-gray-500 flex gap-2">
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        This is a secure 256-bit encrypted simulated checkout.
                    </div>
                </div>

            </div>

            {{-- Right Column: Order Summary --}}
            <div class="lg:w-1/3 mt-6 lg:mt-0">
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-md sticky top-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-5">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        @foreach($cart as $key => $item)
                        @php
                            $imgSrc = match(true) {
                                empty($item['image_path'])                          => null,
                                Str::startsWith($item['image_path'], 'http')        => $item['image_path'],
                                Str::startsWith($item['image_path'], 'assets/')     => asset($item['image_path']),
                                default                                             => asset('storage/' . $item['image_path']),
                            };
                        @endphp
                        <div class="flex gap-4 items-start">
                            <div class="w-16 h-16 bg-gray-50 rounded border border-gray-100 flex items-center justify-center flex-shrink-0 p-1">
                                <img src="{{ $imgSrc ?? asset('assets/images/placeholder-part.png') }}" class="max-h-full object-contain mix-blend-multiply" alt="{{ $item['name'] }}">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-gray-900 line-clamp-2 leading-tight">{{ $item['name'] }}</h4>
                                <div class="text-xs text-gray-500 mt-1">Qty: {{ $item['quantity'] }}</div>
                                <div class="text-sm font-bold text-gray-900 mt-1">RM {{ number_format($item['price'], 2) }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-medium text-gray-900">RM {{ number_format($totalAmount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Estimated Shipping</span>
                            <span class="font-medium text-gray-900">RM {{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Taxes</span>
                            <span class="font-medium text-gray-900">Calculated at checkout</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-900 text-lg">Total</span>
                            <span class="font-black text-brand text-2xl">RM {{ number_format($totalAmount + $shipping, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-brand hover:bg-brand-dark text-white font-bold py-3.5 rounded-lg transition-all shadow-md hover:shadow-lg text-[15px] flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Complete Order
                    </button>
                    
                    <a href="{{ route('cart.index') }}" class="block text-center text-sm font-medium text-brand hover:text-brand-dark mt-4 transition-colors">
                        Return to Cart
                    </a>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
