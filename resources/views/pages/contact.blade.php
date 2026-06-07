@extends('layouts.front')

@section('title', 'Contact Us - BigRadar')

@section('content')
<div class="bg-slate-50 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-4xl font-extrabold text-slate-900 sm:text-5xl">Get in Touch</h1>
            <p class="mt-4 text-xl text-slate-500">Have a question about a product or need support? Our team is here to help.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-24">
            
            <!-- Contact Info -->
            <div class="bg-blue-600 rounded-3xl p-10 text-white shadow-sm border border-gray-900 relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
                
                <h3 class="text-2xl font-bold mb-8 relative z-10">Contact Information</h3>
                
                <div class="space-y-8 relative z-10">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 mt-1 mr-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <div>
                            <p class="font-medium">Our Headquarters</p>
                            <p class="text-blue-100 mt-1">123 Tech Avenue<br>Innovation District<br>Cityville, ST 12345</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <svg class="w-6 h-6 mt-1 mr-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <div>
                            <p class="font-medium">Email Us</p>
                            <p class="text-blue-100 mt-1">support@bigradar.com<br>sales@bigradar.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <svg class="w-6 h-6 mt-1 mr-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <div>
                            <p class="font-medium">Call Us</p>
                            <p class="text-blue-100 mt-1">+1 234 567 8900<br>Mon-Fri, 9am to 6pm EST</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-900">
                <h3 class="text-2xl font-bold text-slate-900 mb-8">Send us a message</h3>
                
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                        <input type="text" name="name" id="name" required class="w-full rounded-xl border border-slate-300 py-3 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email" required class="w-full rounded-xl border border-slate-300 py-3 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-slate-700 mb-1">Subject</label>
                        <input type="text" name="subject" id="subject" required class="w-full rounded-xl border border-slate-300 py-3 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-700 mb-1">Your Message</label>
                        <textarea name="message" id="message" rows="5" required class="w-full rounded-xl border border-slate-300 py-3 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-200 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-1">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
