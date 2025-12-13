<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jobs;
use Illuminate\Support\Str;

class JobWebController extends Controller
{

    public function showCreateJobForm()
    {
        return view('company.jobs.createJob');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary_from' => 'required|numeric|min:0',
            'salary_to' => 'required|numeric|gte:salary_from',
            'status' => 'required|in:active,inactive',
        ]);

        $job = Jobs::create([
            'uuid' => Str::uuid(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'company_uuid' => auth()->user()->uuid,
            'salary_from' => $validated['salary_from'],
            'salary_to' => $validated['salary_to'],
            'status' => $validated['status'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jobs created successfully',
            'data' => $job
        ], 201);
    }

    /**
     * List all jobs created by authenticated company
     */
    public function index()
    {
        $jobs = Jobs::where('company_uuid', auth()->user()->uuid)->get();

        return response()->json([
            'success' => true,
            'data' => $jobs
        ]);
    }

    /**
     * Get job details (Company only, own job)
     */
    public function show(string $uuid)
    {
        $job = Jobs::where('uuid', $uuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->first();

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Jobs not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $job
        ]);
    }

    /**
     * Update job
     */
    public function update(Request $request, string $uuid)
    {
        $job = Jobs::where('uuid', $uuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->first();

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Jobs not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'salary_from' => 'sometimes|numeric|min:0',
            'salary_to' => 'sometimes|numeric|gte:salary_from',
            'status' => 'sometimes|in:active,inactive',
        ]);

        $job->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Job updated successfully',
            'data' => $job
        ]);
    }

    /**
     * Delete job
     */
    public function destroy(string $uuid)
    {
        $job = Jobs::where('uuid', $uuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->first();

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Jobs not found'
            ], 404);
        }

        $job->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jobs deleted successfully'
        ]);
    }



}
