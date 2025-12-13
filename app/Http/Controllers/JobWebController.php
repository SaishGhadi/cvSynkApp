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

    // public function showJobsList()
    // {
    //     return view('company.jobs.index');
    // }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary_from' => 'required|numeric|min:0',
            'salary_to' => 'required|numeric|gte:salary_from',
            

        ]);

        $job = Jobs::create([
            'uuid' => Str::uuid(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'company_uuid' => auth()->user()->uuid,
            'salary_from' => $validated['salary_from'],
            'salary_to' => $validated['salary_to'],
            'status' => 'active',
        ]);

        return redirect()
            ->route('company.jobs.list')
            ->with('success', 'Job created successfully!');
    }

    /**
     * List all jobs created by authenticated company
     */
    public function index()
    {
        $jobs = Jobs::where('company_uuid', auth()->user()->uuid)
            ->select('id', 'uuid', 'title')
            ->get();

        return view('company.jobs.index', compact('jobs'));
    }

    /**
     * Get job details (Company only, own job)
     */
    public function show(string $uuid)
    {
        $job = Jobs::where('uuid', $uuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->firstOrFail();

        return response()->json($job);
    }

    /**
     * Update job
     */
    public function update(Request $request, string $uuid)
    {
        $job = Jobs::where('uuid', $uuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->firstOrFail();

        $job->update($request->validate([
            'title' => 'required',
            'description' => 'required',
            'salary_from' => 'required|numeric',
            'salary_to' => 'required|numeric|gte:salary_from',
        ]));

        return response()->json(['success' => true]);
    }

    /**
     * Delete job
     */
    public function destroy(string $uuid)
    {
        Jobs::where('uuid', $uuid)
            ->where('company_uuid', auth()->user()->uuid)
            ->delete();

        return response()->json(['success' => true]);
    }



}
