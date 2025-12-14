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
    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-3xl font-bold mb-8 text-white">
            Applied Jobs
        </h2>

        @if ($applications->isEmpty())
            <p class="text-white/70">
                You haven’t applied for any jobs yet.
            </p>
        @else
            <div
                class="bg-white/15 backdrop-blur-lg border border-white/20
                    rounded-2xl shadow-lg overflow-hidden">

                <table class="w-full text-left text-white">
                    <thead class="bg-white/10 border-b border-white/20">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Job Title</th>
                            <th class="px-6 py-4 font-semibold">Company</th>
                            <th class="px-6 py-4 font-semibold">Salary</th>
                            <th class="px-6 py-4 font-semibold">Applied On</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($applications as $application)
                            <tr class="border-b border-white/10 hover:bg-white/10 transition">

                                <td class="px-6 py-4 font-medium">
                                    {{ $application->job->title }}
                                </td>

                                <td class="px-6 py-4 text-white/80">
                                    {{ $application->job->company->name }}
                                </td>

                                <td class="px-6 py-4 text-white/80">
                                    ₹{{ number_format($application->job->salary_from) }} –
                                    ₹{{ number_format($application->job->salary_to) }}
                                </td>

                                <td class="px-6 py-4 text-white/80">
                                    {{ $application->created_at->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'selected' => 'bg-yellow-500/20 text-yellow-200',
                                            'applied' => 'bg-green-500/20 text-green-200',
                                            'rejected' => 'bg-red-500/20 text-red-200',
                                        ];
                                    @endphp

                                    <span
                                        class="px-4 py-1 rounded-full text-sm font-semibold
                                    {{ $statusClasses[$application->status] }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <form method="POST"
                                        action="{{ route('candidate.application.revoke', $application->uuid) }}"
                                        onsubmit="return confirm('Revoke this application?')">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="px-4 py-1.5 rounded-full bg-red-500
                                               hover:bg-red-600 transition font-semibold">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @endif
    </div>
@endsection
