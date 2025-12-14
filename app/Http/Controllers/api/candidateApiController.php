<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jobs;
use App\Models\Applications;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class candidateApiController extends Controller
{
    /**
     * Apply for a job (Candidate only)
     */
    public function apply(Request $request, string $uuid)
    {
        // Fetch active job
        $job = Jobs::where('uuid', $uuid)
            ->where('status', 'active')
            ->first();

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Job not found or inactive'
            ], 404);
        }

        // Prevent duplicate application
        $alreadyApplied = Applications::where('job_uuid', $job->uuid)
            ->where('candidate_uuid', auth()->user()->uuid)
            ->exists();

        if ($alreadyApplied) {
            return response()->json([
                'success' => false,
                'message' => 'You have already applied for this job'
            ], 409);
        }

        // Create application
        $application = Applications::create([
            'uuid' => Str::uuid(),
            'job_uuid' => $job->uuid,
            'candidate_uuid' => auth()->user()->uuid,
            'status' => 'applied',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully',
            'data' => $application
        ], 201);
    }

    /**
     * Get all applications of logged-in candidate
     */
    public function index()
    {
        $applications = Applications::with(['job.company'])
            ->where('candidate_uuid', auth()->user()->uuid)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $applications
        ]);
    }

    /**
     * Revoke application (Candidate only, own application)
     */
    public function destroy(string $uuid)
    {
        $application = Applications::where('uuid', $uuid)
            ->where('candidate_uuid', auth()->user()->uuid)
            ->first();

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found'
            ], 404);
        }

        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Application revoked successfully'
        ]);
    }
}
