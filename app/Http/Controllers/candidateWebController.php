<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Jobs;
use Illuminate\Http\Request;

class candidateWebController extends Controller
{

    public function load()
    {
        // 1. Fetch the data
        $jobs = Jobs::where('status', 'active')->latest()->get();

        // 2. Load the view and pass the data
        return view('candidate.dashboard', compact('jobs'));
    }


public function show(string $uuid)
{
    $Applications = Applications::where('uuid', $uuid)
        ->where('candidate_uuid', auth()->user()->uuid)
        ->firstOrFail();

   return view('candidate.appliedJobs', compact('Applications'));
}

}
