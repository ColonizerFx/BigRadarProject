@extends('layouts.front')

@section('title', 'My Account - RigRadar')

@section('content')
<div class="bg-slate-50 min-h-[calc(100vh-100px)]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ tab: 'profile' }">
        <h1 class="text-2xl font-bold text-gray-900 mb-8" style="font-family: 'Inter', sans-serif;">My Account</h1>
        
        @if(session('status') === 'profile-updated')
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-8">
                Profile updated successfully.
            </div>
        @endif

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <div class="w-full md:w-64 flex-shrink-0">
                <div class="bg-white rounded-2xl border border-gray-100 py-6 px-4 shadow-sm flex flex-col space-y-4">
                    <button @click="tab = 'profile'" :class="tab === 'profile' ? 'bg-[#E8EFFF] text-blue-600' : 'text-gray-700 hover:bg-gray-50'" class="w-full text-left px-6 py-3.5 rounded-xl text-sm font-medium transition-colors">Profile</button>
                    <button @click="tab = 'order'" :class="tab === 'order' ? 'bg-[#E8EFFF] text-blue-600' : 'text-gray-700 hover:bg-gray-50'" class="w-full text-left px-6 py-3.5 rounded-xl text-sm font-medium transition-colors">Order</button>
                    <button @click="tab = 'address'" :class="tab === 'address' ? 'bg-[#E8EFFF] text-blue-600' : 'text-gray-700 hover:bg-gray-50'" class="w-full text-left px-6 py-3.5 rounded-xl text-sm font-medium transition-colors">Address</button>
                    
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-left px-6 py-3.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1">
                <!-- Profile Tab -->
                <div x-show="tab === 'profile'" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sm:p-10">
                    <h2 class="text-xl font-bold text-gray-900 mb-8">Profile</h2>
                    
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
                        @csrf
                        @method('patch')
                        
                        <div>
                            <label class="block text-sm text-gray-500 mb-2">Email Address</label>
                            <div class="relative">
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-500 cursor-not-allowed focus:ring-0" readonly>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm text-gray-500 mb-2">First Name</label>
                                <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name', $user->first_name ?? $user->name) }}" class="w-full border border-gray-100 rounded-xl px-4 py-3 text-sm text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder-gray-400 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 mb-2">Last Name</label>
                                <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name', $user->last_name) }}" class="w-full border border-gray-100 rounded-xl px-4 py-3 text-sm text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder-gray-400 shadow-sm">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm text-gray-500 mb-2">Mobile Number</label>
                            <div class="flex gap-4">
                                <div class="relative w-32">
                                    <select class="w-full border border-gray-100 rounded-xl pl-4 pr-8 py-3 text-sm text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all shadow-sm appearance-none bg-white cursor-pointer">
                                        <option>MY +60</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <input type="text" name="mobile_number" placeholder="e.g., 123456789" value="{{ old('mobile_number', $user->mobile_number) }}" class="flex-1 border border-gray-100 rounded-xl px-4 py-3 text-sm text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder-gray-400 shadow-sm">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm text-gray-500 mb-2">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" placeholder="Leave blank to keep current" class="w-full border border-gray-100 rounded-xl px-4 py-3 pr-10 text-sm text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder-gray-400 shadow-sm">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-500 mb-2">Confirm Password</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" placeholder="Confirm new password" class="w-full border border-gray-100 rounded-xl px-4 py-3 pr-10 text-sm text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all placeholder-gray-400 shadow-sm">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl text-sm transition-colors shadow-sm">Save Changes</button>
                        </div>
                    </form>
                </div>

                <!-- Order Tab -->
                <div x-show="tab === 'order'" style="display: none;" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sm:p-10">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Details</h2>
                    <div class="text-sm text-gray-700">You have no orders.</div>
                </div>

                <!-- Address Tab -->
                <div x-show="tab === 'address'" style="display: none;" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sm:p-10">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 px-1">Address</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Example Default Address -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:border-blue-200 transition-colors">
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <span class="text-gray-500 text-sm">,, MY</span>
                                    <span class="text-[10px] font-bold text-blue-600 bg-blue-50 border border-blue-100 px-2 py-1 rounded">Default</span>
                                </div>
                            </div>
                            <div class="flex gap-4 mt-6 text-sm text-gray-600 font-medium">
                                <button class="flex items-center gap-1 hover:text-blue-600 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg> Edit</button>
                                <button class="flex items-center gap-1 hover:text-red-600 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Delete</button>
                            </div>
                        </div>
                        
                        <!-- Add Address Button -->
                        <button class="bg-slate-50 border-2 border-dashed border-gray-200 rounded-xl p-6 flex flex-col items-center justify-center min-h-[160px] hover:bg-gray-100 hover:border-gray-300 transition-colors group">
                            <div class="bg-white p-3 rounded-full shadow-sm group-hover:scale-110 transition-transform mb-3 border border-gray-100">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-700">Add New Address</span>
                        </button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
