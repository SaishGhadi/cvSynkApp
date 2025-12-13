@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-10">Company Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Manage Jobs (Expandable ONLY this card) --}}
            <div
                class="group bg-white/15 backdrop-blur-lg border border-white/20 
                   rounded-2xl overflow-hidden transition-all duration-300">

                {{-- Card Header --}}
                <div class="p-6">
                    <h3 class="text-xl font-semibold">Manage Jobs</h3>
                    <p class="text-white/80 mt-1">
                        Create, edit, or manage job listings.
                    </p>
                </div>

                {{-- Hover Expand Area --}}
                <div
                    class="max-h-0 group-hover:max-h-40 overflow-hidden 
                       transition-all duration-300 ease-in-out 
                       border-t border-white/10 bg-white/10">

                    <div class="flex justify-center gap-4 py-6">
                        <a href="{{ route('company.job.create') }}"
                                class="px-6 py-2 rounded-full bg-white text-[#003A75] 
                              font-semibold shadow hover:scale-105 transition">
                                Create Job
                            </a>

                            <a href="{{ route('company.jobs.list') }}"
                                class="px-6 py-2 rounded-full bg-blue-600 
                              font-semibold shadow hover:bg-blue-700 transition">
                                Existing Jobs
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Applications --}}
                <a href="#"
                    class="bg-white/15 backdrop-blur-lg border border-white/20 
                  rounded-2xl p-6 hover:bg-white/20 transition">

                    <h3 class="text-xl font-semibold">Applications</h3>
                    <p class="text-white/80 mt-1">
                        View candidates who applied for your jobs.
                    </p>
                </a>

            </div>
        </div>
@endsection
