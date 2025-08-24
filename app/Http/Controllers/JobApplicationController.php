<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{

    private function findUserJob($request, $id) {
        return JobApplication::where('user_id',$request->user()->id)
            ->findOrFail($id);
    }

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

    public function show(Request $request, $id) {

        $job = $this->findUserJob($request, $id);

        return response()->json($job);
    }

    public function update(Request $request, $id) {

        $job = $this->findUserJob($request, $id);

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'company' => 'sometimes|nullable|string|max:255',
            'link' => 'sometimes|nullable|url|max:2048',
            'status' => 'sometimes|required|string|in:saved,applied,interview,offer,rejected',
            'notes' => 'sometimes|nullable|string',
        ]);

        $job->update($data);

        return response()->json($job);
    }

    public function destroy(Request $request, $id) {
        $job = $this->findUserJob($request, $id);

        $job->delete();

        return response()->json(['message' => 'Deleted'], 200);
    }
}
