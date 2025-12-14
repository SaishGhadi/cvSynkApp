@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6">

    <h2 class="text-3xl font-bold mb-8">Your Active Jobs</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($jobs as $job)
            <a href="{{ route('company.applications.list', $job->uuid) }}"
               class="bg-white/15 backdrop-blur-lg border border-white/20
                      rounded-2xl p-6 hover:bg-white/20 transition text-white">

                <h3 class="text-xl font-semibold">{{ $job->title }}</h3>

                <p class="mt-2 text-white/80">
                    Applications: 
                    <span class="font-bold">{{ $job->applications_count }}</span>
                </p>
            </a>
        @endforeach
    </div>

</div>
@endsection
