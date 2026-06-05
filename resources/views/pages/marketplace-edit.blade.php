@extends('layouts.front')

@section('title', 'Edit Listing - BigRadar')

@section('content')
<div class="w-full px-4 md:px-8 xl:px-12 mx-auto py-12">
    <div class="max-w-3xl mx-auto bg-white border border-gray-200 rounded-lg shadow-sm p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Your Listing</h2>
        
        <form action="{{ route('marketplace.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{ $listing->title }}" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="e.g. Used RTX 3080 10GB">
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option {{ $listing->category == 'Graphics Card' ? 'selected' : '' }}>Graphics Card</option>
                            <option {{ $listing->category == 'Processor' ? 'selected' : '' }}>Processor</option>
                            <option {{ $listing->category == 'Motherboard' ? 'selected' : '' }}>Motherboard</option>
                            <option {{ $listing->category == 'Memory' ? 'selected' : '' }}>Memory</option>
                            <option {{ $listing->category == 'Storage' ? 'selected' : '' }}>Storage</option>
                            <option {{ $listing->category == 'Power Supply' ? 'selected' : '' }}>Power Supply</option>
                            <option {{ $listing->category == 'Cooling & Fans' ? 'selected' : '' }}>Cooling & Fans</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Condition</label>
                        <select name="condition" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option {{ $listing->condition == 'New (Open Box)' ? 'selected' : '' }}>New (Open Box)</option>
                            <option {{ $listing->condition == 'Used - Like New' ? 'selected' : '' }}>Used - Like New</option>
                            <option {{ $listing->condition == 'Used - Good' ? 'selected' : '' }}>Used - Good</option>
                            <option {{ $listing->condition == 'Used - Fair' ? 'selected' : '' }}>Used - Fair</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price (RM)</label>
                        <input type="number" step="0.01" name="price" value="{{ $listing->price }}" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Your Location</label>
                        <input type="text" name="location" value="{{ $listing->location }}" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="e.g. Kuala Lumpur">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="4" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Describe the item condition, usage history, etc.">{{ $listing->description }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Image (Optional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @if($listing->image_path)
                        <div class="mt-2 text-xs text-gray-500">Current image will be kept if no new file is selected.</div>
                    @endif
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline text-sm font-medium">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded-md transition-colors shadow-sm">
                    Update Listing
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
