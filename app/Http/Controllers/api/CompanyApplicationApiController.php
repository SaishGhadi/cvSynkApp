<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Jobs;
use Illuminate\Http\Request;

class CompanyApplicationApiController extends Controller
{
    public function jobs()
    {
        $jobs = Jobs::where('company_uuid', auth()->user()->uuid)
            ->where('status', 'active')
            ->withCount('applications')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $jobs
        ]);
    }

    // Show applications for a specific job usign uuid of job
    public function applications(string $jobUuid)
    {
        $companyUuid = auth()->user()->uuid;

        $job = Jobs::where('uuid', $jobUuid)
            ->where('company_uuid', $companyUuid)
            ->first();

        if (!$job) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized or job not found'
            ], 403);
        }

        $applications = Applications::with('candidate')
            ->where('job_uuid', $job->uuid)
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'job' => $job,
            'applications' => $applications
        ]);
    }

    // Accept an application
    public function accept(string $applicationUuid)
    {
        $companyUuid = auth()->user()->uuid;

        $application = Applications::where('uuid', $applicationUuid)
            ->whereHas('job', function ($query) use ($companyUuid) {
                $query->where('company_uuid', $companyUuid);
            })
            ->first();

        if (!$application) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action'
            ], 403);
        }

        if ($application->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Application already processed'
            ], 422);
        }

        $application->update([
            'status' => 'accepted'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Candidate accepted'
        ]);
    }


    // Reject an application
    public function reject(string $applicationUuid)
    {
        $companyUuid = auth()->user()->uuid;

        $application = Applications::where('uuid', $applicationUuid)
            ->whereHas('job', function ($query) use ($companyUuid) {
                $query->where('company_uuid', $companyUuid);
            })
            ->first();

        if (!$application) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action'
            ], 403);
        }

        if ($application->status !== 'pending') {
            return response()->json([
                'status' => false,
                'message' => 'Application already processed'
            ], 422);
        }

        $application->update([
            'status' => 'rejected'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Candidate rejected'
        ]);
    }

}
