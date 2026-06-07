<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\MarketplaceListing;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $conversations = Conversation::where('buyer_id', $userId)
            ->orWhere('seller_id', $userId)
            ->with(['buyer', 'seller', 'marketplaceListing'])
            ->latest('updated_at')
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function show($id)
    {
        $userId = Auth::id();
        $conversation = Conversation::with(['buyer', 'seller', 'marketplaceListing', 'messages.sender'])
            ->where(function($query) use ($userId) {
                $query->where('buyer_id', $userId)->orWhere('seller_id', $userId);
            })
            ->findOrFail($id);

        // Mark unread messages as read
        $conversation->messages()->where('sender_id', '!=', $userId)->where('is_read', false)->update(['is_read' => true]);

        return view('chat.show', compact('conversation'));
    }

    public function store(Request $request, $id)
    {
        $request->validate(['message' => 'required|string']);
        
        $userId = Auth::id();
        $conversation = Conversation::where(function($query) use ($userId) {
                $query->where('buyer_id', $userId)->orWhere('seller_id', $userId);
            })->findOrFail($id);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $userId,
            'message' => $request->message,
        ]);

        $conversation->touch(); // Update updated_at for sorting

        // Send notification to the other user
        $receiver = $conversation->buyer_id == $userId ? $conversation->seller : $conversation->buyer;
        $receiver->notify(new NewMessageNotification($message));

        return back();
    }

    public function initiate(Request $request)
    {
        $request->validate(['listing_id' => 'required|exists:marketplace_listings,id']);
        
        $listing = MarketplaceListing::findOrFail($request->listing_id);
        $buyerId = Auth::id();
        $sellerId = $listing->user_id;

        if ($buyerId == $sellerId) {
            return back()->with('error', 'You cannot message yourself.');
        }

        $conversation = Conversation::firstOrCreate([
            'marketplace_listing_id' => $listing->id,
            'buyer_id' => $buyerId,
            'seller_id' => $sellerId,
        ]);

        return redirect()->route('chat.show', $conversation->id);
    }
}
