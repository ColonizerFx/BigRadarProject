@extends('layouts.front')

@section('title', 'Chat - RigRadar')

@section('content')
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-10 h-[calc(100vh-100px)] flex flex-col">
    @php
        $otherUser = $conversation->buyer_id == Auth::id() ? $conversation->seller : $conversation->buyer;
    @endphp
    
    <div class="border border-gray-900 rounded-xl flex flex-col h-full overflow-hidden shadow-sm">
        <div class="bg-white border-b border-gray-100 p-4 flex items-center">
            <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-gray-600 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                {{ substr($otherUser->name ?? $otherUser->first_name ?? 'U', 0, 1) }}
            </div>
            <div class="ml-3">
                <h2 class="font-bold text-gray-900">{{ $otherUser->name ?? $otherUser->first_name ?? 'User' }}</h2>
                <p class="text-xs text-gray-500">Regarding: {{ $conversation->marketplaceListing->title ?? 'Deleted Listing' }}</p>
            </div>
        </div>

        {{-- Listing Item Banner --}}
        @if($conversation->marketplaceListing)
            @php
                $listing = $conversation->marketplaceListing;
                $imgSrc = match(true) {
                    !$listing->image_path => null,
                    Str::startsWith($listing->image_path, 'http') => $listing->image_path,
                    Str::startsWith($listing->image_path, 'assets/') => asset($listing->image_path),
                    default => asset('storage/' . $listing->image_path),
                };
            @endphp
            <div class="bg-gray-50 border-b border-gray-200 px-4 py-3">
                <div class="flex items-center gap-3 border border-gray-300 rounded-xl px-3 py-2.5 bg-white shadow-sm">
                    {{-- Thumbnail --}}
                    <div class="w-14 h-14 rounded-lg border border-gray-200 overflow-hidden flex-shrink-0 bg-gray-100 flex items-center justify-center">
                        @if($imgSrc)
                            <img src="{{ $imgSrc }}" alt="{{ $listing->title }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @endif
                    </div>
                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $listing->title }}</p>
                        <p class="text-sm font-bold text-gray-800">RM {{ number_format($listing->price, 2) }}</p>
                    </div>
                    {{-- Actions --}}
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('marketplace.details', $listing->id) }}" target="_blank" class="text-xs font-semibold text-gray-700 border border-gray-300 px-3 py-1.5 rounded-lg hover:bg-gray-50 transition-colors whitespace-nowrap">View Listing ↗</a>
                        <button type="button" onclick="sendOffer()" class="text-xs font-semibold text-white bg-brand px-3 py-1.5 rounded-lg hover:bg-brand-dark transition-colors whitespace-nowrap">Make Offer</button>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex-1 bg-slate-50 p-6 overflow-y-auto flex flex-col space-y-4">
            @foreach($conversation->messages as $msg)
                <div class="flex {{ $msg->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }} animate-fade-in-up">
                    <div class="max-w-[70%] {{ $msg->sender_id == Auth::id() ? 'bg-blue-600 text-white rounded-l-xl rounded-tr-xl' : 'bg-white border border-gray-100 text-gray-800 rounded-r-xl rounded-tl-xl' }} px-4 py-2 shadow-sm">
                        <p class="text-sm">{{ $msg->message }}</p>
                        <p class="text-[10px] {{ $msg->sender_id == Auth::id() ? 'text-blue-200' : 'text-gray-400' }} mt-1 text-right">
                            {{ $msg->created_at->format('g:i A') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-white border-t border-gray-100 p-4">
            <form action="{{ route('chat.store', $conversation->id) }}" method="POST" class="flex gap-4">
                @csrf
                <input type="text" name="message" class="flex-1 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2" placeholder="Type your message..." required autocomplete="off" autofocus>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg text-sm transition-colors">Send</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Scroll to bottom of chat
    const chatContainer = document.querySelector('.overflow-y-auto');
    chatContainer.scrollTop = chatContainer.scrollHeight;

    function sendOffer() {
        const input = document.querySelector('[name=message]');
        const form = input.closest('form');
        input.value = 'Hi, I\'m interested in buying {{ addslashes($listing->title ?? '') }}. Is it still available?';
        form.submit();
    }
</script>
@endsection
