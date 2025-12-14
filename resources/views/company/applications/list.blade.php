@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-6">
            Applications — {{ $job->title }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @forelse ($applications as $app)
                <div
                    class="bg-white/15 backdrop-blur-lg border border-white/20
                        rounded-2xl p-6 text-white">

                    <h3 class="text-xl font-semibold">
                        {{ $app->candidate->name }}
                    </h3>

                    <p class="mt-2 text-white/80">
                        Skills:
                        {{ implode(', ', $app->candidate->skills ?? []) }}
                    </p>

                    <p class="mt-2">
                        Status:
                        <span
                            class="font-semibold
                            @if ($app->status === 'applied') text-yellow-400
                            @elseif($app->status === 'selected') text-green-400
                            @else text-red-400 @endif">
                            {{ ucfirst($app->status) }}
                        </span>
                    </p>


                    @if ($app->status === 'applied')
                        <div class="flex gap-3 mt-4">
                            <form method="POST" action="{{ route('company.application.accept', $app->uuid) }}">
                                @csrf
                                <button
                                    class="px-5 py-2 rounded-full bg-green-600 hover:bg-green-700 transition font-semibold">
                                    Select
                                </button>
                            </form>

                            <form method="POST" action="{{ route('company.application.reject', $app->uuid) }}">
                                @csrf
                                <button class="px-5 py-2 rounded-full bg-red-600 hover:bg-red-700 transition font-semibold">
                                    Reject
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            @empty
                <p class="text-white/80">No applications found.</p>
            @endforelse

        </div>
    </div>
@endsection
