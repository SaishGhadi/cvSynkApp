@extends('layouts.app')

@section('content')
@include('layouts.navbar')

<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Candidate Dashboard</h2>

    <div class="grid grid-cols-1 gap-6">

        <!-- View Active Jobs -->
        <a href="{{ route('candidate.jobs') }}"
           class="p-6 bg-white shadow rounded-lg hover:shadow-md transition">
            <h3 class="text-xl font-semibold">Browse Active Jobs</h3>
            <p class="text-gray-600">See all available jobs and apply instantly.</p>
        </a>

        <!-- My Applications -->
        <a href="{{ route('candidate.applications') }}"
           class="p-6 bg-white shadow rounded-lg hover:shadow-md transition">
            <h3 class="text-xl font-semibold">My Applications</h3>
            <p class="text-gray-600">View job applications and their status.</p>
        </a>

    </div>
</div>

@endsection
