<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Applications;

class CompanyApplicationController extends Controller
{
    /**
     * Show company jobs with application count
     */
    public function jobs()
    {
        $jobs = Jobs::where('company_uuid', auth()->user()->uuid)
            ->where('status', 'active')
            ->withCount('applications')
            ->get();

        return view('company.applications.jobs', compact('jobs'));
    }

    /**
     * Show applications for a job
     */
    public function applications(string $jobUuid)
    {
        $job = Jobs::where('uuid', $jobUuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->firstOrFail();

        $applications = Applications::with('candidate')
            ->where('job_uuid', $job->uuid)
            ->latest()
            ->get();

        return view('company.applications.list', compact('job', 'applications'));
    }

    /**
     * Accept an application
     */
    public function accept(string $applicationUuid)
    {
        Applications::where('uuid', $applicationUuid)
            ->update(['status' => 'SELECTED']);

        return back()->with('success', 'Candidate selected');
    }

    /**
     * Reject an application
     */
    public function reject(string $applicationUuid)
    {
        Applications::where('uuid', $applicationUuid)
            ->update(['status' => 'rejected']);

        return back()->with('success', 'Candidate rejected');
    }
}
