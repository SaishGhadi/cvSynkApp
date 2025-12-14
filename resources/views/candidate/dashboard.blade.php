@extends('layouts.app')

@section('content')
{{-- Success Message --}}
@if (session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Error Messages --}}
@if ($errors->any())
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="max-w-7xl mx-auto px-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-3xl font-bold text-white">
            Available Jobs
        </h2>

        <a href="{{ route('candidate.applied.jobs') }}"
           class="px-5 py-2 rounded-full bg-white text-[#003A75]
                  font-semibold shadow hover:scale-105 transition">
            Applied Jobs
        </a>
    </div>

    {{-- Jobs Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse ($jobs as $job)
            <div class="bg-white/15 backdrop-blur-lg border border-white/20
                        rounded-2xl shadow-lg p-6 flex flex-col
                        hover:bg-white/20 transition">

                <h3 class="text-xl font-semibold text-white mb-2">
                    {{ $job->title }}
                </h3>

                <p class="text-white/80 text-sm mb-4 line-clamp-3 leading-relaxed">
                    {{ $job->description }}
                </p>

                <div class="text-sm text-white/90 mb-6">
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
                        class="w-full py-2.5 rounded-full bg-white text-[#003A75]
                               font-semibold shadow hover:scale-105 transition">
                        Quick Apply
                    </button>
                </form>

            </div>
        @empty
            <p class="text-white/70">
                No active jobs available right now.
            </p>
        @endforelse

    </div>
</div>
@endsection
