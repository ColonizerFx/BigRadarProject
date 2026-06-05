@extends('layouts.front')

@section('title', 'Shopping Cart - BigRadar')

@section('content')
<div class="w-full px-4 md:px-8 xl:px-12 mx-auto py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <ul class="divide-y divide-gray-200">
                        @php $total = 0; @endphp
                        @foreach($cart as $key => $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <li class="p-6 flex items-center">
                                <div class="w-24 h-24 bg-gray-50 border border-gray-100 rounded p-2 flex-shrink-0 flex items-center justify-center">
                                    <img src="{{ $item['image_path'] ? asset('storage/'.$item['image_path']) : 'https://images.unsplash.com/photo-1591488320449-011701bb6704' }}" alt="" class="max-h-full object-contain mix-blend-multiply">
                                </div>
                                <div class="ml-6 flex-1">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">Sold by: {{ $item['retailer_name'] }}</p>
                                    <p class="text-lg font-bold text-gray-900 mt-2">RM {{ number_format($item['price'], 2) }} <span class="text-sm font-normal text-gray-500">x {{ $item['quantity'] }}</span></p>
                                </div>
                                <div class="ml-4">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cart_key" value="{{ $key }}">
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Remove</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 sticky top-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Order Summary</h3>
                    <div class="flex justify-between text-sm text-gray-600 mb-3">
                        <span>Subtotal</span>
                        <span>RM {{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600 mb-4 pb-4 border-b border-gray-200">
                        <span>Shipping</span>
                        <span class="text-green-600">Calculated at checkout</span>
                    </div>
                    <div class="flex justify-between text-xl font-bold text-gray-900 mb-6">
                        <span>Total</span>
                        <span>RM {{ number_format($total, 2) }}</span>
                    </div>
                    
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-full transition-colors">
                            Proceed to Checkout
                        </button>
                    </form>
                    <p class="text-xs text-center text-gray-500 mt-4">Simulated checkout. Clicking this will process an order directly to your profile history.</p>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-white border border-gray-200 rounded-lg">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-6">Looks like you haven't added any PC parts to your cart yet.</p>
            <a href="{{ route('products') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md transition-colors">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
