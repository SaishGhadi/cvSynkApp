@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-[#003A75]">
                Applied Jobs
            </h2>

            <a href="{{ route('candidate.dashboard') }}"
                class="px-5 py-2 rounded-full bg-blue-600 text-white
                  font-semibold hover:bg-blue-700 transition">
                Back to Jobs
            </a>
        </div>

        {{-- Applied Jobs --}}
        <table class="w-full text-left text-white">
                <thead class="bg-white/10 border-b border-white/20">
                    <tr>
                        <th class="px-6 py-4 font-semibold">ID</th>
                        <th class="px-6 py-4 font-semibold">Title</th>
                        <th class="px-6 py-4 font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($Applications as $application)
                        <tr class="border-b border-white/10 hover:bg-white/10 transition">
                            <td class="px-6 py-4 text-white/80">
                                {{ $application->id }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $application->title }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex gap-2">

                                    <button onclick="viewJob('{{ $application->uuid }}')"
                                        class="px-4 py-1.5 rounded-full bg-white/20 
                                           hover:bg-white/30 transition font-semibold">
                                        View
                                    </button>

                                    <button onclick="editJob('{{ $application->uuid }}')"
                                        class="px-4 py-1.5 rounded-full bg-blue-600 
                                           hover:bg-blue-700 transition font-semibold">
                                        Edit
                                    </button>

                                    <button onclick="deleteJob('{{ $application->uuid }}')"
                                        class="px-4 py-1.5 rounded-full bg-red-500 
                                           hover:bg-red-600 transition font-semibold">
                                        Delete
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @empty
                <p class="text-gray-600">
                    You haven’t applied for any jobs yet.
                </p>
            @endforelse

        </div>
    </div>
@endsection
