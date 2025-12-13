@extends('layouts.app')

@section('content')
@include('layouts.navbar')

<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Company Dashboard</h2>

    <div class="grid grid-cols-1 gap-6">

        <!-- Manage Jobs -->
        <a href="{{ route('company.jobs') }}"
           class="p-6 bg-white shadow rounded-lg hover:shadow-md transition">
            <h3 class="text-xl font-semibold">Manage Jobs</h3>
            <p class="text-gray-600">Create, edit, or delete job listings.</p>
        </a>

        <!-- View Applications -->
        <a href="{{ route('company.applicants') }}"
           class="p-6 bg-white shadow rounded-lg hover:shadow-md transition">
            <h3 class="text-xl font-semibold">Applications</h3>
            <p class="text-gray-600">View candidates who applied for your jobs.</p>
        </a>

    </div>
</div>

@endsection
