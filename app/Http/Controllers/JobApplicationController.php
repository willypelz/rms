<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Order;
use App\User;
use App\Models\Transaction;
use App\Models\OrderItem;
use App\Models\CompanyFolder;
use App\Models\FolderContent;
use Illuminate\Http\Request;
use App\Libraries\Solr;
use Cart;
use Auth;
use Mail;
use Carbon\Carbon;


class JobApplicationController extends Controller
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

    
    
}
