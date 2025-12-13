@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="max-w-4xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-8">Create New Job</h2>

        <div class="bg-white/15 backdrop-blur-lg border border-white/20 
                rounded-2xl p-8 shadow-lg">

            <form method="POST" action="{{ route('company.jobs.store') }}">
                @csrf

                {{-- Job Title (ALONE) --}}
                <div class="mb-6">
                    <label class="block mb-1 font-semibold">Job Title</label>
                    <input type="text" name="title"
                        class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                           text-white placeholder-white/60 focus:outline-none
                           focus:ring-2 focus:ring-blue-300"
                        placeholder="e.g. Laravel Developer">
                </div>

                {{-- Salary (Side by Side) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block mb-1 font-semibold">Salary From (₹)</label>
                        <input type="number" name="salary_from" value="20000"
                            class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                               text-white focus:outline-none
                               focus:ring-2 focus:ring-blue-300">
                    </div>

                    <div>
                        <label class="block mb-1 font-semibold">Salary To (₹)</label>
                        <input type="number" name="salary_to" value="30000"
                            class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30
                               text-white focus:outline-none
                               focus:ring-2 focus:ring-blue-300">
                    </div>
                </div>

                {{-- Job Description (LAST) --}}
                <div class="mb-8">
                    <label class="block mb-1 font-semibold">Job Description</label>
                    <textarea name="description" rows="5"
                        class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30
                           text-white placeholder-white/60 focus:outline-none
                           focus:ring-2 focus:ring-blue-300"
                        placeholder="Describe job responsibilities, skills required, experience, etc."></textarea>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-4">
                    <a href="{{ route('company.dashboard') }}"
                        class="px-6 py-2 rounded-full bg-white/20 hover:bg-white/30
                          transition font-semibold">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 rounded-full bg-white text-[#003A75]
                           font-semibold shadow hover:scale-105 transition">
                        Create Job
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
