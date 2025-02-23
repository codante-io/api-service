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
        // if slow flag is passed, lets delay 2 seconds to simulate a slow response
        if (request()->has('slow')) {
            sleep(5);
        }

        $query = Job::query();

        if (request()->has('search')) {
            $searchTerm = request()->input('search');
            $query->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('company', 'like', "%{$searchTerm}%")
                  ->orWhere('city', 'like', "%{$searchTerm}%");
        }

        return JobResource::collection($query->orderBy('created_at', 'desc')->get());
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
        if (request()->has('slow')) {
            sleep(2);
        }

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

    public function commentsIndex()
    {
        if (request()->has('slow')) {
            sleep(4);
        }

        return [
            'data' => [
                [
                    'id' => 1,
                    'author' => 'Carlos Cândido',
                    'content' => 'Eu acho essa empresa muito boa. Eu adoraria trabalhar aqui',
                ],
                [
                    'id' => 2,
                    'author' => 'Joacir Figueiredo',
                    'content' => 'Eu não tenho certeza sobre essa vaga',
                ],
                [
                    'id' => 3,
                    'author' => 'Larissa Navegante',
                    'content' => 'Eu acho que essa vaga é perfeita para mim',
                ],
            ],
        ];
    }

    public function reset()
    {
        Artisan::call('api:job-board:reset');

        return response()->json(['message' => 'Database reset']);
    }
}
