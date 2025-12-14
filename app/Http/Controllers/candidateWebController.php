<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class candidateWebController extends Controller
{

    public function load()
    {
        // 1. Fetch the data
        $jobs = Jobs::where('status', 'active')->latest()->get();

        // 2. Load the view and pass the data
        return view('candidate.dashboard', compact('jobs'));
    }

    // function to create new application
    public function apply(Request $request, string $uuid)
    {
        // Ensure authenticated & candidate
        if (!auth()->check() || auth()->user()->role !== 'candidate') {
            abort(403, 'Only candidates can apply for jobs.');
        }

        // Fetch active job
        $job = Jobs::where('uuid', $uuid)
            ->where('status', 'active')
            ->firstOrFail();

        // Prevent duplicate application
        $alreadyApplied = Applications::where('job_uuid', $job->uuid)
            ->where('candidate_uuid', auth()->user()->uuid)
            ->exists();

        if ($alreadyApplied) {
            return redirect()
                ->back()
                ->with('error', 'You have already applied for this job.');
        }

        // Create application
        Applications::create([
            'uuid' => Str::uuid(),
            'job_uuid' => $job->uuid,
            'candidate_uuid' => auth()->user()->uuid,
            'status' => 'applied',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Application submitted successfully!');
    }

    public function index()
    {
        $applications = Applications::with(['job.company'])
            ->where('candidate_uuid', auth()->user()->uuid)
            ->latest()
            ->get();

        return view('candidate.appliedJobs', compact('applications'));
    }

    public function destroy(string $uuid)
    {
        Applications::where('uuid', $uuid)
            ->where('candidate_uuid', auth()->user()->uuid)
            ->delete();

        return redirect()
            ->route('candidate.applied.jobs')
            ->with('success', 'Application Deleted successfully');
    }


}
