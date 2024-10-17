<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $jobs = Job::latest()->get()->groupBy('featured');

        return view('job.index', [
            'jobs' => $jobs[0],
            'featuredJobs' => $jobs[1],
            'tags' => Job::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $attributes = $request->validate([
               'title'=>['required'],
               'salary'=>['required'],
               'location'=>['required'],
               'schedule'=>['required', Rule::in(['Full-Time', 'Part-Time', 'Remote'])],
               'url'=>['required', 'active_url'],
               
        ]);

        $attributes['featured'] = $request->has('featured');

       $job =  Auth::user()->employer->job()->create($attributes);

        return redirect('/');
    }

    
}
