@extends('layouts.admin_layout')

@section('title', 'Home - DMCO')

@section('content')
<div class="min-h-screen font-poppins">
    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl text-blue-400 font-medium mb-6">
                DEMANKCO
            </h2>
        </div>

        <!-- Featured Image -->
        <div class="max-w-4xl mx-auto overflow-hidden rounded-lg shadow-lg">
            <img src="/images/dmco.png" alt="Soccer Player" class="w-full h-full object-fill" />
        </div>

        <!-- Additional Content or Product Grid can be added here -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
            <!-- You can add product cards or additional content here -->
        </div>
    </main>
</div>
@endsection
