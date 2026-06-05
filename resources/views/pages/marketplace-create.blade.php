@extends('layouts.front')

@section('title', 'Sell an Item - BigRadar')

@section('content')
<div class="w-full px-4 md:px-8 xl:px-12 mx-auto py-12">
    <div class="max-w-3xl mx-auto bg-white border border-gray-200 rounded-lg shadow-sm p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">List an Item on the Marketplace</h2>
        
        <form action="{{ route('marketplace.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="e.g. Used RTX 3080 10GB">
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option>Graphics Card</option>
                            <option>Processor</option>
                            <option>Motherboard</option>
                            <option>Memory</option>
                            <option>Storage</option>
                            <option>Power Supply</option>
                            <option>Cooling & Fans</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Condition</label>
                        <select name="condition" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option>New (Open Box)</option>
                            <option>Used - Like New</option>
                            <option>Used - Good</option>
                            <option>Used - Fair</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price (RM)</label>
                        <input type="number" step="0.01" name="price" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Your Location</label>
                        <input type="text" name="location" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="e.g. Kuala Lumpur">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="4" required class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Describe the item condition, usage history, etc."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded-md transition-colors shadow-sm">
                    Publish Listing
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
