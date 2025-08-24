<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index(Request $request) {
        $jobs = JobApplication::where('/user_id', $request->user()->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($jobs);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:2048',
            'status' => 'required|string|in:saved,applied,interview,offer,rejected',
            'notes' => 'nullable|string',
        ]);

        $job = JobApplication::create($data + [
            'user_id' => $request->user()->id,
        ]);

        return response()->json($job, 201);
    }
}
