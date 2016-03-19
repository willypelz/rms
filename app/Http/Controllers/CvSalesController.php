<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Libraries\Solr;


class CvSalesController extends Controller
{
    private $search_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'post_date+desc', 'grouped'=>FALSE ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function search(Request $request)
    {

            $this->search_params['q'] = $request->search_query;
            $response = Solr::search_resume($this->search_params);

            return view('cv-sales.search-results',['result' => $response]);
    }
}
