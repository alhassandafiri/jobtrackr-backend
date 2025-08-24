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
}
