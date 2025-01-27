<?php

namespace App\Http\Controllers\JobBoard;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobBoard\StoreJobRequest;
use App\Http\Requests\JobBoard\UpdateJobRequest;
use App\Http\Resources\JobBoard\JobResource;
use App\Models\JobBoard\Job;
use Illuminate\Support\Facades\Artisan;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return JobResource::collection(Job::all()->sortByDesc('created_at'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $job = Job::create($request->all());

        return new JobResource($job);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return new JobResource($job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {

        $job->update($request->all());

        return new JobResource($job);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
    }

    public function reset()
    {
        Artisan::call('api:job-board:reset');

        return response()->json(['message' => 'Database reset']);
    }
}
