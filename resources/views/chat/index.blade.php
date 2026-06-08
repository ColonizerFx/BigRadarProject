@extends('layouts.front')

@section('title', 'My Messages - RigRadar')

@section('content')
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-10">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">Messages</h1>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-900 overflow-hidden">
        @if($conversations->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($conversations as $conv)
                    @php
                        $otherUser = $conv->buyer_id == Auth::id() ? $conv->seller : $conv->buyer;
                        $unread = $conv->messages->where('sender_id', '!=', Auth::id())->where('is_read', false)->count();
                    @endphp
                    <a href="{{ route('chat.show', $conv->id) }}" class="flex items-center p-4 hover:bg-slate-50 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                            {{ substr($otherUser->name ?? $otherUser->first_name ?? 'U', 0, 1) }}
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="font-bold text-gray-900">{{ $otherUser->name ?? $otherUser->first_name ?? 'User' }}</h3>
                                <span class="text-xs text-gray-400">{{ $conv->updated_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Listing: {{ $conv->marketplaceListing->title ?? 'Deleted Listing' }}</p>
                        </div>
                        @if($unread > 0)
                            <div class="ml-4 bg-red-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                                {{ $unread }}
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center text-gray-500 text-sm">
                You have no active conversations.
            </div>
        @endif
    </div>
</div>
@endsection
