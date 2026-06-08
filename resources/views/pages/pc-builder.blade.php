@extends('layouts.front')

@section('title', 'PC Builder - BigRadar')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="pcBuilder()">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-4">
        <a href="{{ url('/') }}" class="hover:text-brand transition-colors">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900 font-medium">PC Builder</span>
    </nav>

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900" style="font-family: 'Inter', sans-serif;">🔧 PC Builder</h1>
        <p class="text-gray-500 mt-2 text-sm">Select your parts to build your dream PC. Prices are pulled live from official retailers.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Part Selector Table --}}
        <div class="flex-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-900 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900">Select Your Components</h2>
                    <button @click="clearAll()" class="text-xs text-gray-400 hover:text-red-500 transition-colors font-medium">Clear All</button>
                </div>

                {{-- Part Slots --}}
                @foreach($partsBySlot as $slotLabel => $parts)
                <div class="border-b border-gray-50 last:border-0">
                    <div class="px-6 py-4 flex items-start gap-4">
                        {{-- Slot Label --}}
                        <div class="w-32 flex-shrink-0 pt-1">
                            <span class="text-sm font-bold text-gray-700">{{ $slotLabel }}</span>
                            @if($slotLabel === 'CPU' || $slotLabel === 'GPU' || $slotLabel === 'RAM')
                                <span class="block text-xs text-brand font-medium mt-0.5">Essential</span>
                            @else
                                <span class="block text-xs text-gray-400 mt-0.5">Optional</span>
                            @endif
                        </div>

                        {{-- Part Selector --}}
                        <div class="flex-1">
                            @if(count($parts) > 0)
                                <select
                                    @change="selectPart('{{ $slotLabel }}', $event.target.value, $event.target.options[$event.target.selectedIndex].dataset.price, $event.target.options[$event.target.selectedIndex].dataset.name, $event.target.options[$event.target.selectedIndex].dataset.availability, $event.target.options[$event.target.selectedIndex].dataset.image)"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:ring-brand focus:border-brand transition-all cursor-pointer hover:border-gray-300">
                                    <option value="">— Choose {{ $slotLabel }} —</option>
                                    @foreach($parts as $part)
                                        @php
                                            $minPrice = $part->retailers->min('pivot.price') ?? 0;
                                            $availability = $part->retailers->where('pivot.availability_status', 'In Stock')->count() > 0 ? 'In Stock' : 'Check Store';
                                            $imgSrc = match(true) {
                                                !$part->image_path => null,
                                                Str::startsWith($part->image_path, 'http') => $part->image_path,
                                                Str::startsWith($part->image_path, 'assets/') => asset($part->image_path),
                                                default => asset('storage/'.$part->image_path),
                                            };
                                        @endphp
                                        <option
                                            value="{{ $part->id }}"
                                            data-price="{{ $minPrice }}"
                                            data-name="{{ $part->name }}"
                                            data-availability="{{ $availability }}"
                                            data-image="{{ $imgSrc ?? asset('assets/images/placeholder-part.png') }}">
                                            {{ $part->name }}
                                            @if($minPrice > 0) — RM {{ number_format($minPrice, 2) }} @endif
                                        </option>
                                    @endforeach
                                </select>

                                {{-- Selected Part Preview --}}
                                <div x-show="selectedParts['{{ $slotLabel }}']" class="mt-3 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded border border-gray-100 bg-white flex items-center justify-center overflow-hidden flex-shrink-0">
                                        <img :src="selectedParts['{{ $slotLabel }}']?.image" class="w-8 h-8 object-contain mix-blend-multiply" alt="">
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-gray-500 font-medium">
                                        <span class="w-2 h-2 rounded-full shadow-sm"
                                              :class="selectedParts['{{ $slotLabel }}']?.availability === 'In Stock' ? 'bg-green-500' : 'bg-yellow-400'"></span>
                                        <span x-text="selectedParts['{{ $slotLabel }}']?.availability ?? ''"></span>
                                    </div>
                                </div>
                            @else
                                <div class="text-sm text-gray-400 italic px-4 py-3 bg-gray-50 rounded-xl border border-gray-200">
                                    No {{ $slotLabel }} parts in database yet
                                </div>
                            @endif
                        </div>

                        {{-- Part Price --}}
                        <div class="w-28 text-right pt-3 flex-shrink-0">
                            <span class="text-sm font-bold text-gray-900"
                                  x-text="selectedParts['{{ $slotLabel }}'] ? 'RM ' + Number(selectedParts['{{ $slotLabel }}'].price).toLocaleString('en-MY', {minimumFractionDigits: 2}) : '—'"></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Summary Panel (sticky wrapper to fix overlap) --}}
        <div class="w-full lg:w-80 flex-shrink-0 sticky top-6 h-max">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-900 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h2 class="font-black text-gray-900 text-lg">Build Summary</h2>
                </div>

                {{-- Selected Parts List --}}
                <div class="px-6 py-4 space-y-3 max-h-72 overflow-y-auto">
                    @foreach(array_keys($partsBySlot) as $slotLabel)
                    <div x-show="selectedParts['{{ $slotLabel }}']" class="flex justify-between items-start gap-2 text-sm">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded border border-gray-100 bg-white flex items-center justify-center overflow-hidden flex-shrink-0">
                                <img :src="selectedParts['{{ $slotLabel }}']?.image" class="w-8 h-8 object-contain mix-blend-multiply" alt="">
                            </div>
                            <div>
                                <div class="font-semibold text-gray-500 text-xs uppercase tracking-wide">{{ $slotLabel }}</div>
                                <div class="text-gray-900 font-medium text-xs mt-0.5 leading-tight line-clamp-2" x-text="selectedParts['{{ $slotLabel }}']?.name ?? ''"></div>
                            </div>
                        </div>
                        <span class="text-gray-900 font-bold text-sm whitespace-nowrap"
                              x-text="selectedParts['{{ $slotLabel }}'] ? 'RM ' + Number(selectedParts['{{ $slotLabel }}'].price).toLocaleString('en-MY', {minimumFractionDigits: 2}) : ''"></span>
                    </div>
                    @endforeach

                    <template x-if="totalParts === 0">
                        <p class="text-sm text-gray-400 text-center py-4">No parts selected yet.</p>
                    </template>
                </div>

                {{-- Total --}}
                <div class="px-6 py-5 border-t border-gray-100 bg-gray-50">
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-bold text-gray-700">Estimated Total</span>
                        <span class="text-2xl font-black text-brand" x-text="'RM ' + totalPrice.toLocaleString('en-MY', {minimumFractionDigits: 2})"></span>
                    </div>
                    <div class="text-xs text-gray-400 mb-4 text-center" x-show="totalParts > 0">
                        <span x-text="totalParts"></span> part(s) selected — prices from cheapest retailer
                    </div>

                    {{-- CTA --}}
                    <div class="space-y-3 mt-4">
                        <button type="button" class="flex items-center justify-center gap-2 w-full bg-white border border-gray-900 text-gray-900 hover:bg-gray-50 font-bold py-3.5 rounded-full hover-lift transition-all text-sm shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Add to Cart
                        </button>
                        <a href="{{ route('cart.checkout.view') }}" class="flex items-center justify-center gap-2 w-full bg-brand hover:bg-brand-dark text-white font-bold py-3.5 rounded-full hover-lift transition-all text-sm shadow-md border border-gray-900">
                            Proceed to Checkout
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Tip Card --}}
            <div class="mt-4 bg-white border border-gray-900 rounded-2xl px-5 py-4 text-sm shadow-sm">
                <p class="font-bold text-gray-900 mb-1">💡 Compatibility Tip</p>
                <p class="text-gray-600 text-xs leading-relaxed">Ensure your CPU and Motherboard share the same socket (e.g., LGA1700 for Intel 12th/13th gen, AM5 for Ryzen 7000).</p>
            </div>
        </div>
    </div>
</div>

{{-- Alpine.js PC Builder Logic --}}
<script>
    function pcBuilder() {
        return {
            selectedParts: {},
            get totalPrice() {
                return Object.values(this.selectedParts).reduce((sum, part) => sum + parseFloat(part.price || 0), 0);
            },
            get totalParts() {
                return Object.values(this.selectedParts).filter(p => p && p.price > 0).length;
            },
            selectPart(slot, id, price, name, availability, image) {
                if (!id) {
                    delete this.selectedParts[slot];
                    this.selectedParts = { ...this.selectedParts };
                    return;
                }
                this.selectedParts[slot] = { id, price: parseFloat(price) || 0, name, availability, image };
                this.selectedParts = { ...this.selectedParts };
            },
            clearAll() {
                this.selectedParts = {};
                document.querySelectorAll('select[\\@change]').forEach(s => s.value = '');
            }
        }
    }
</script>
@endsection
