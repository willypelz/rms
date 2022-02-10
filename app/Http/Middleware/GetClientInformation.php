<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetClientInformation
{
    /**
     * Handle an incoming request and push the url into 
     * request body if it exists in clients tbale.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            $currentUrl = url(''); 
            cache()->flush(); 
            $client = DB::table('clients')->where('url', $currentUrl)->first();
           
            $companyIds = Company::where('client_id',$client->id)->pluck('id');
            $request->merge(['clientId' => $client->id, 'companyIds' => $companyIds]);

            if (!session()->get('current_company_index')) {
                \session()->put('current_company_index', $companyIds->first());
            }

            if (!session()->get('active_company')) {
                \session()->put('active_company', Company::find($companyIds->first()));
            }

            return $next($request);
            
        }catch(Exception $e){
            abort(404);
        }
    }
}
