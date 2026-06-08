@extends('layouts.front')

@section('title', 'About Us - RigRadar')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative h-[380px] overflow-hidden">
        <img class="absolute inset-0 w-full h-full object-cover" src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Office workspace">
        <div class="absolute inset-0 bg-gradient-to-r from-black/65 via-black/30 to-transparent"></div>
        <div class="relative h-full flex items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl drop-shadow-lg">About RigRadar</h1>
                <p class="mt-4 max-w-xl text-lg text-white/75 leading-relaxed">
                    Helping Malaysians find the best deals on PC parts, laptops, and tech gear — all in one place.
                </p>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl mb-6">Our Story</h2>
                <div class="space-y-4 text-slate-600 text-[16px] leading-relaxed">
                    <p>
                        RigRadar started in 2026 as a university project born out of a pretty relatable frustration — trying to build a PC in Malaysia and having no idea where to get the best price. Is TMT cheaper than Harvey Norman for that GPU? Does All IT have it in stock? You'd have to check five tabs just to find out.
                    </p>
                    <p>
                        We built RigRadar to fix that. One place where you can compare prices for GPUs, CPUs, motherboards, RAM, and everything else you need — pulled from real Malaysian retailers, so you always know you're getting a fair deal.
                    </p>
                    <p>
                        Beyond official retailer listings, we also have a user marketplace where you can buy and sell second-hand parts. Because not everyone needs a brand new RTX card, and a good used one at the right price is just as valid a choice.
                    </p>
                    <p>
                        We're a small team that genuinely cares about the local PC building scene. If you're putting together your first rig or upgrading your setup, RigRadar is here to make that process less of a headache.
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
