<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke()
    {                              //LIKE is used for pattern matching
                            //where() Eloquent is used to build a SQL  //get() when the query executes it shows as an collection
       $jobs =  Job::where('title', 'LIKE', '%'.request('q').'%')->get();

       return view('Components.results', ['jobs' => $jobs]);
    }
}
