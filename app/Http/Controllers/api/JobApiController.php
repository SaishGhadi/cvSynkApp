<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobApiController extends Controller
{
    /**
     * Create a new job (Company only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'salary_from' => ['required', 'numeric', 'min:0'],
            'salary_to' => ['required', 'numeric', 'gte:salary_from'],
            'status' => ['required', 'in:active,inactive'],

        ]);

        $job = Jobs::create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'description' => $request->description,
            'company_uuid' => auth()->user()->uuid,
            'salary_from' => $request->salary_from,
            'salary_to' => $request->salary_to,
            'status' => 'active',
        ]);

        return response()->json([
            'message' => 'Jobs created successfully',
            'job' => $job
        ], 201);
    }

    /**
     * Get all jobs created by the company
     */
    public function index()
    {
        $jobs = Jobs::where('company_uuid', auth()->user()->uuid)->get();

        return response()->json([
            'jobs' => $jobs
        ]);
    }

    /**
     * Get single job details (Company only, own job)
     */
    public function show(string $uuid)
    {
        $job = Jobs::where('uuid', $uuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->first();

        if (!$job) {
            return response()->json(['message' => 'Jobs not found'], 404);
        }

        return response()->json([
            'job' => $job
        ]);
    }

    /**
     * Update job (Company only, own job)
     */
    public function update(Request $request, string $uuid)
    {
        $job = Jobs::where('uuid', $uuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->first();

        if (!$job) {
            return response()->json(['message' => 'Jobs not found'], 404);
        }

        $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'salary_from' => ['sometimes', 'numeric', 'min:0'],
            'salary_to' => ['sometimes', 'numeric', 'gte:salary_from'],
            'status' => ['sometimes', 'in:active,inactive'],
        ]);

        $job->update($request->only([
            'title',
            'description',
            'salary_from',
            'salary_to',
            'status'
        ]));

        return response()->json([
            'message' => 'Jobs updated successfully',
            'job' => $job
        ]);
    }

    /**
     * Delete job (Company only, own job)
     */
    public function destroy(string $uuid)
    {
        $job = Jobs::where('uuid', $uuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->first();

        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        $job->delete();

        return response()->json([
            'message' => 'Jobs deleted successfully'
        ]);
    }
}
