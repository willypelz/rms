<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Curl;
use App\Models\Company;
use App\Models\Job;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashbaord()
    {

        // $comp = Auth::user()->companies;
        // $comp_id = ($comp[0]->id);

        // $jobs = Job::with('activities')->where('company_id', $comp_id)->get();
        // dd($jobs->toArray());


        $response = Curl::to('https://api.insidify.com/articles/get-posts')
                                ->withData(array('limit'=>6))
                                ->post();

        $posts = json_decode($response)->data->posts;

        return view('talent-pool.dashboard', compact('posts'));
    }
}
