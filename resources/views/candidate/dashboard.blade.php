@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-[#003A75]">
            Available Jobs
        </h2>

        <a href="{{ route('candidate.applied.jobs') }}"
           class="px-5 py-2 rounded-full bg-blue-600 text-white
                  font-semibold hover:bg-blue-700 transition">
            Applied Jobs
        </a>
    </div>

    {{-- Jobs Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse ($jobs as $job)
            <div class="bg-white border border-blue-100 rounded-2xl shadow
                        hover:shadow-lg transition p-6 flex flex-col">

                <h3 class="text-xl font-semibold text-[#003A75] mb-2">
                    {{ $job->title }}
                </h3>

                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                    {{ $job->description }}
                </p>

                <div class="text-sm text-gray-700 mb-4">
                    <span class="font-semibold">Salary:</span>
                    ₹{{ number_format($job->salary_from) }} –
                    ₹{{ number_format($job->salary_to) }}
                </div>

                {{-- Quick Apply --}}
                <form method="POST"
                      action="{{ route('candidate.jobs.apply', $job->uuid) }}"
                      class="mt-auto">
                    @csrf
                    <button type="submit"
                        class="w-full py-2 rounded-full bg-[#003A75] text-white
                               font-semibold hover:bg-blue-700 transition">
                        Quick Apply
                    </button>
                </form>

            </div>
        @empty
            <p class="text-gray-600">
                No active jobs available right now.
            </p>
        @endforelse

    </div>
</div>
@endsection
