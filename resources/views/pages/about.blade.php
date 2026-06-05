@extends('layouts.front')

@section('title', 'About Us - BigRadar')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-blue-600">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover mix-blend-multiply opacity-20" src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Office workspace">
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">About BigRadar</h1>
            <p class="mt-6 max-w-3xl mx-auto text-xl text-blue-100">
                We are on a mission to bring the world's most advanced mobile technology directly to you. Fast, reliable, and premium.
            </p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl mb-6">Our Story</h2>
                <div class="prose prose-lg text-slate-600">
                    <p>
                        Founded in 2026 as part of a university project, BigRadar started with a simple idea: purchasing a new mobile device shouldn't be complicated. We wanted to build a platform that strips away the jargon and focuses on what truly matters - the user experience and cutting-edge technology.
                    </p>
                    <p>
                        Today, BigRadar represents the pinnacle of mobile e-commerce. We carefully curate our catalog to include only the highest quality devices, ensuring that our customers always receive the best value for their investment. 
                    </p>
                    <p>
                        Our team is passionate about tech and dedicated to providing unparalleled customer service. Whether you're a casual user or a tech enthusiast, BigRadar is your ultimate destination for mobile innovation.
                    </p>
                </div>
            </div>
            <div class="mt-12 lg:mt-0 relative rounded-3xl overflow-hidden shadow-2xl">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Team working" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
            </div>
        </div>
    </div>
</div>
@endsection
